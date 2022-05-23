<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\Cart;
use app\models\User;
use app\models\Order;

class OrderController extends Controller {
    public static string $layout = "main";

    public static function handleAddOrder() {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['user'];
        $userId = $userInfor->id;
        // $userId = $userInfor->username;
        $products = Cart::__self__()->getProductFromCart($userId);
        $storeList = array_values(array_unique(array_column($products, 'storeId'))); 
        // $status = 0;
        forEach($storeList as $store) {
            // đặt tên biến orderId = gọi hàm tạo order_id
            $orderId = strtoupper(substr(md5($userId.microtime().rand(1,10)), -10));
            // gọi hàm thêm order
            Order::__self__()->addOrder($orderId, $userId, $store, 0, 0);
            forEach($products as $product) {
                // nếu sp trùng địa chỉ store thì mới:
                // gọi hàm thêm vào order details (orderId....)
                if($product['storeId'] == $store) {
                    Order::__self__()->addOrderDetail($orderId, $product['id'], 
                    $product['productPrice'], $product['quantity']);
                }
            }
            // // đặt tên biến là total = hàm tính tổng đơn theo chi nhánh (truyền storeId)
            $total = Order::__self__()->totalOrderPrice($orderId);
            // gọi hàm update total của đơn hàng và truyền vào total
            Order::__self__()->updateOrderTotal($orderId, $userId, $store, $total['totalPrice']);
        }
        Cart::__self__()->deleteAllCartItemOfUser($userId);
        return json_encode(["status" => $total]);    
    }
    
    public static function handleUpdateStatus(Request $request) {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['user'];
        $userId = $userInfor->id;
        $body = $request->body();
        $status = $body['status'];
        $orderId = $body['orderId'];
        Order::__self__()->updateOrderStatus($orderId, $userId, $status);
        return json_encode(["status" => true]); 
    }

    public static function handleStatusClick(Request $request) {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['user'];
        $userId = $userInfor->id;
        $body = $request->body();
        $status = $body['status'];
        if($status == -1) {
            $orders = Order::__self__()->getAllUserOrder($userId);
        } else {
            $orders = Order::__self__()->getOrderByStatus($userId, $status);
        }
        $orderDetails = Order::__self__()->getOrderInforById($userId);
        if($orders == null) {
            return json_encode(["status" => false]);
        } else {
            return json_encode(["status" => true, "orders" => $orders, "orderDetails" => $orderDetails]);
        }
    }

    public static function handleRenderOrder() {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['user'];
        $userId = $userInfor->id;
        $orders = Order::__self__()->getAllUserOrder($userId);
        $orderDetails = Order::__self__()->getOrderInforById($userId);
        return parent::render("order", ["orders" => $orders, "orderDetails" => $orderDetails]);
    }
}