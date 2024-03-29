<?php

namespace app\models;

use core\Model;

class Order extends Model
{
    const TABLE = 'cart';
    private self $Order;
    public int $id;
    public int $user_id;
    public int $store_id;
    public int $status;
    public int $total;
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
    }

    public static function __self__()
    {
        return new static();
    }

    public function fillInstance($id, $user_id, $store_id, $status, $total, $created_at, $updated_at)
    {
        $this->Order->id = $id;
        $this->Order->user_id = $user_id;
        $this->Order->store_id = $store_id;
        $this->Order->status = $status;
        $this->Order->total = $total;
        $this->Order->created_at = $created_at;
        $this->Order->updated_at = $updated_at;
    }

    public function setUserId($user_id)
    {
        $this->Order->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->Order->user_id;
    }

    public function getAllUserOrder($id)
    {
        $data = [];
        $sql = self::$db->query("SELECT orders.*
        FROM orders, user
        WHERE  orders.user_id = user.id
        AND user.id = '$id'");
        while ($row = mysqli_fetch_all($sql, 1)) {
            $data = $row;
        }
        return $data;
    }

    public function getOrderByStatus($userId, $status)
    {
        $data = [];
        $sql = self::$db->query("SELECT orders.*, store.address 
        FROM orders, store, user 
        WHERE orders.store_id = store.id AND orders.user_id = user.id 
        AND orders.status = '$status' AND user.id = '$userId'");

        while ($row = mysqli_fetch_all($sql, 1)) {
            $data = $row;
        }
        return $data;
    }

    public function getOrderInforById($id)
    {
        $data = [];
        $sql = self::$db->query("SELECT product.*, order_details.price  
        AS productPrice, order_details.quantity, order_details.order_id, 
        order_details.total
        FROM product, order_details, orders, user
        WHERE product.id = order_details.product_id 
        AND order_details.order_id = orders.id
        AND orders.user_id = user.id AND user.id = '$id'");

        while ($row = mysqli_fetch_all($sql, 1)) {
            $data = $row;
        }
        return $data;
    }

    public function getOrderInforByOrderId($orderId)
    {
        $data = [];
        $sql = self::$db->query("SELECT product.*, order_details.price  
        AS productPrice, order_details.quantity, order_details.order_id
        FROM product, order_details, orders
        WHERE product.id = order_details.product_id 
        AND order_details.order_id = orders.id 
        AND orders.id = '$orderId'");

        while ($row = mysqli_fetch_all($sql, 1)) {
            $data = $row;
        }
        return $data;
    }

    public function addOrder($order_id, $user_id, $store_id, $total, $status)
    {
        return self::$db->query("INSERT INTO orders (`id`,`user_id`,`store_id`, 
        `total`, `status`) VALUES ('$order_id', '$user_id','$store_id', '$total', '$status')");
    }

    public function addOrderDetail($order_id, $product_id, $price, $quantity, $total)
    {
        return self::$db->query("INSERT INTO order_details (`order_id`,`product_id`,`price`, 
        `quantity`, `total`) VALUES ('$order_id', '$product_id', '$price', '$quantity', '$total')");
    }

    public function updateOrderTotal($order_id, $user_id, $store_id, $total)
    {
        return self::$db->query("UPDATE orders SET total = '$total' 
        WHERE id = '$order_id' AND user_id = '$user_id' AND 
        store_id = '$store_id'");
    }

    public function updateOrderStatus($order_id, $userId, $status)
    {
        return self::$db->query("UPDATE orders SET `status` = '$status' 
        WHERE id = '$order_id' AND user_id = '$userId'");
    }

    public function totalOrderPrice($orderId)
    {
        $sql = self::$db->query("SELECT SUM(price*quantity) AS totalPrice
        FROM orders, order_details, store, user
        WHERE order_details.order_id = orders.id AND orders.store_id = store.id 
        AND orders.user_id = user.id and orders.id = '$orderId'");
        while ($row = mysqli_fetch_array($sql, 1)) {
            $data = $row;
        }
        return $data;
    }

    public function getOrderByStoreId($storeId = NULL)
    {

        $data = [];
        if (!$storeId)
            $sql = "select o.*, u.username from orders as o, user as u where o.user_id = u.id";
        else
            $sql = "select o.*, u.username from orders as o, user as u where o.user_id = u.id and o.store_id = $storeId";

        $result = self::$db->query($sql);
        while ($row = mysqli_fetch_all($result, 1)) $data = $row;

        return $data;
    }

    public function getRevenue($storeId = NULL)
    {

        $data = [];
        if (!$storeId)
            $sql = "select p.*, po.*, c.title from product as p, ( select product_id, sum(quantity) as quantity_sold, sum(od.total) as total 
        from order_details as od
        group by product_id ) as po, category as c
        where p.id = po.product_id and c.id = p.category_id";
        else
            $sql = "select p.*, po.*, c.title from product as p, ( select product_id, sum(quantity) as quantity_sold, sum(od.total) as total 
        from orders as o, order_details as od
        where o.id = od.order_id and o.store_id = $storeId
        group by product_id ) as po, category as c
        where p.id = po.product_id and c.id = p.category_id";

        $result = self::$db->query($sql);
        while ($row = mysqli_fetch_all($result, 1)) $data = $row;

        return $data;
    }

    public function getEntireOrders()
    {
        $data = [];
        $sql = self::$db->query("SELECT orders.id, orders.status, orders.total, orders.created_at, user.username from orders, user where orders.user_id = user.id");
        while ($row = mysqli_fetch_all($sql, 1)) {
            $data = $row;
        }
        return $data;
    }
}
