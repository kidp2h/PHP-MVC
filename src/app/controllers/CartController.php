<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\Cart;
use app\models\User;
use core\Response;

class CartController extends Controller {
  private static self $instance;
  public static string $layout = "main";
  
  public static function hook(){
    parent::setLayout(self::$layout);
  }

  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new CartController();
    }
    return self::$instance;
  }

  public static function handleAddToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];
    $amount = $body['amount'];

    $cartItem = Cart::__self__()->getCartByUserId($userId);

    $isFind = false;
    for ($i=0; $i < count($cartItem); $i++) { 
        if($cartItem[$i]['product_id'] == $productId) {
            $isFind = true;
            $amount += (int)$cartItem[$i]['quantity'];
            Cart::__self__()->updateProductToCart($userId, $productId, 2,$amount);
        } 
    }
    if(!$isFind) {
      Cart::__self__()->addProductToCart($userId, $productId, 2, $amount);
    }

    return json_encode(["status" => $cartItem]);
  }

  public static function handleUpdateToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];
    $amount = $body['amount'];

    Cart::__self__()->updateProductToCart($userId, $productId, 1, $amount);
    return json_encode(["status" => true]);
  }

  public static function handleDeleteToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];

    Cart::__self__()->deleteProductFromCart($userId, $productId);
    return json_encode(["status" => true]);
  }

  public static function handleRenderCart(){
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $userName = $userInfor->username;
    $CartProducts = Cart::__self__()->getProductFromCart($userName);
    return parent::render("cart",["productList" => $CartProducts]);
  }

  public static function handleRenderCartModal(){ 
    // if(!isset($_COOKIE["accessToken"])) 
    //   return json_encode(["status" => false, "productList" => '']);
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $userName = $userInfor->username;
    $CartProducts = Cart::__self__()->getProductFromCart($userName);
    $CartTotalPrice = Cart::__self__()->totalPriceOfCart($userName);
    return json_encode(["status" => true, "productList" => $CartProducts, "cartTotalPrice" => $CartTotalPrice]);
  }
}
?>
