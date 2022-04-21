<?php
namespace app\models;
use core\Model;

class Cart extends Model {
    const TABLE = 'cart';
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

    public function addProductToCart($user_id, $product_id, $quantity) {
        return self::$db->query("INSERT INTO cart_item (`user_id`, `product_id`, `quantity`) 
        VALUES ('$user_id', '$product_id', '$quantity')");
    }

    public function updateProductToCart($user_id, $product_id, $quantity) {
        return self::$db->query("UPDATE cart_item SET quantity = '$quantity' 
        WHERE product_id = '$product_id' and user_id = '$user_id'");
    }

    public function deleteProductFromCart($user_id, $product_id) {
        return self::$db->query("DELETE FROM cart_item 
        WHERE product_id = '$product_id' AND user_id = '$user_id'");
    }

    public function getProductFromCart($username) {
        $data = [];
        $sql = self::$db->query("SELECT product.*, cart_item.quantity 
        FROM product, user,cart_item WHERE product.id = cart_item.product_id 
        AND cart_item.user_id = user.id AND user.username = '$username'");
        while($row = mysqli_fetch_all($sql,1)) {
            $data = $row;
        }
        return $data;
    }

    public function totalPriceOfCart($username) {
        $sql = self::$db->query("SELECT SUM(quantity*price) AS totalPrice
        FROM cart_item, product, user WHERE product.id = cart_item.product_id 
        AND cart_item.user_id = user.id AND user.username = '$username';");
        while($row = mysqli_fetch_all($sql,1)) {
            $data = $row;
        }
        return $data;
    }
}