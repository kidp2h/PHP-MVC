<?php
namespace app\models;
use core\Model;

class Cart extends Model {
    private self $Cart;
    public int $user_id;
    public int $product_id;
    public int $quantity;

    public function __construct() {

    }

    public static function __self__() {
        return new static();
    }

    public function fillInstance($user_id, $product_id, $quantity) {
        $this->Cart->user_id = $user_id;
        $this->Cart->product_id = $product_id;
        $this->Cart->quantity = $quantity;
    }

    public function setUserId($user_id){
        $this->Cart->user_id = $user_id;
    }

    public function getUserId(){
        return $this->Cart->user_id;
    }

    public function setProductId($product_id){
        $this->Cart->product_id = $product_id;
    }

    public function getProductId(){
        return $this->Cart->product_id;
    }

    public function setQuantity($quantity){
        $this->Cart->quantity = $quantity;
    }

    public function getQuantity(){
        return $this->Cart->quantity;
    }

    public function getCartByUserId($id) {
        $data = [];
        $sql = self::$db->query("SELECT * FROM cart_item WHERE cart_item.user_id = '$id'");
        while($row=mysqli_fetch_all($sql,1)) {
            $data=$row;
        }
        return $data;
    }

    public function getCartByUsername($username) {
        $data = [];
        $sql = self::$db->query("SELECT cart_item* FROM cart_item, user 
        WHERE cart_item.user_id = user.id and user.username = '$username'");
        while($row=mysqli_fetch_all($sql,1)) {
            $data=$row;
        }
        return $data;
    }

    public function addProductToCart($user_id, $product_id, $store_id, $quantity) {
        return self::$db->query("INSERT INTO cart_item (`user_id`, `product_id`, 
        `store_id`,`quantity`) VALUES ($user_id, '$product_id', $store_id, '$quantity')");
    }

    public function updateProductToCart($user_id, $product_id, $store_id, $quantity) {
        return self::$db->query("UPDATE cart_item SET quantity = '$quantity' 
        WHERE product_id = '$product_id' and user_id = '$user_id' AND 
        store_id = '$store_id'");
    }

    public function deleteProductFromCart($user_id, $product_id, $store_id) {
        return self::$db->query("DELETE FROM cart_item 
        WHERE product_id = '$product_id' AND user_id = '$user_id' 
        AND store_id = '$store_id'");
    }

    public function deleteAllCartItemOfUser($userId) {
        return self::$db->query("DELETE FROM cart_item 
        WHERE cart_item.user_id = '$userId'");
    }

    // Lấy ra các chi nhánh mà người dùng đã thêm hàng
    // public function getStoreUserAddedItem($id) {
    //     $data = [];
    //     $sql = self::$db->query("SELECT DISTINCT store.id 
    //     FROM user, cart_item, store 
    //     WHERE user.id = cart_item.user_id AND cart_item.store_id = store.id 
    //     AND user.id = '$id'");
    //     while($row = mysqli_fetch_all($sql,1)) {
    //         $data = $row;
    //     }
    //     return $data;
    // }

    public function getProductFromCart($userId) {
        $data = [];
        $sql = self::$db->query("SELECT product.*, cart_item.quantity, store.id AS storeId, 
        store.address, product.price*(1 - product_details.discount/100) AS productPrice 
        FROM product, product_details, store , user, cart_item 
        WHERE product.id = cart_item.product_id AND cart_item.user_id = user.id 
        AND cart_item.store_id = store.id AND product.id = product_details.product_id 
        AND product_details.store_id = store.id AND user.id = '$userId'");
        while($row = mysqli_fetch_all($sql,1)) {
            $data = $row;
        }
        return $data;
    }

    public function totalPriceOfCart($userId) {
        $sql = self::$db->query("SELECT SUM(cart_item.quantity*
        (product.price*(1 - product_details.discount/100))) AS totalPrice
        FROM product, product_details, store , user, cart_item 
        WHERE product.id = cart_item.product_id AND cart_item.user_id = user.id 
        AND cart_item.store_id = store.id AND product.id = product_details.product_id 
        AND product_details.store_id = store.id AND user.id = '$userId'");
        while($row = mysqli_fetch_array($sql,1)) {
            $data = $row;
        }
        return $data;
    }
}