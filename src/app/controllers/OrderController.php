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
        $userInfor = $result['result'];
        $userId = $userInfor->id;
        $userName = $userInfor->username;
        $products = Cart::__self__()->getProductFromCart($userName);
        $storeList = []; // mai set
        $status = 0;
        $total = [];
        forEach($storeList as $store) {
            // đặt tên biến orderId = gọi hàm tạo order_id
            // gọi hàm thêm order
            forEach($products as $product) {
                // nếu sp trùng địa chỉ store thì mới:
                // gọi hàm thêm vào order details (orderId....)
            }
            // đặt tên biến là total = hàm tính tổng đơn theo chi nhánh (truyền storeId)
            // gọi hàm update total của đơn hàng và truyền vào total
        }
        return json_encode(["status" => true]);    
    }
    
    public static function handleUpdateStatus(Request $request) {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['result'];
        $userId = $userInfor->id;
        $body = $request->body();
        $status = $body['status'];
        switch ($status) {
            case 1:
                // gọi hàm update status cho đơn hàng
            case 2:
                // gọi hàm update status cho đơn hàng
            default: 
                break;
        }

        return json_encode(["status" => true]); 
    }

    public static function handleStatusClick(Request $request) {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['result'];
        $userId = $userInfor->id;
        $body = $request->body();
        $status = $body['status'];
        switch ($status) {
            case 0:
                // gọi hàm lấy ra tất cả đơn pending
            case 1:
                // gọi hàm lấy ra tất cả đơn đã xác nhận
            case 2:
                // gọi hàm lấy ra tất cả đơn đã huỷ
            default: 
                break;
        }
        return json_encode(["status" => true, "orderProducts" => 'sản phẩm']);
    }

    public static function handleRenderOrder() {
        $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
        $userInfor = $result['result'];
        $userId = $userInfor->id;
        $userName = $userInfor->username;
        $Products = Cart::__self__()->getProductFromCart($userName);
        //remember to delete all product in Cart
        return parent::render("order", ["orderProducts" => $Products]);
    }
}