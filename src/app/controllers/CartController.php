<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\Cart;
use app\models\User;

class CartController extends Controller {
  public static string $layout = "main";

  public static function handleAddToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];
    $amount = $body['amount'];
    $storeId = $body['storeId'];

    $cartItem = Cart::__self__()->getCartByUserId($userId);

    $isFind = false;
    for ($i=0; $i < count($cartItem); $i++) { 
        if($cartItem[$i]['product_id'] == $productId) {
            $isFind = true;
            $amount += (int)$cartItem[$i]['quantity'];
            Cart::__self__()->updateProductToCart($userId, $productId, $storeId, $amount);
        } 
    }
    if(!$isFind) {
      Cart::__self__()->addProductToCart($userId, $productId, $storeId, $amount);
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
    $storeId = $body['storeId'];

    Cart::__self__()->updateProductToCart($userId, $productId, $storeId, $amount);
    return json_encode(["status" => true]);
  }

  public static function handleDeleteToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];
    $storeId = $body['storeId'];

    Cart::__self__()->deleteProductFromCart($userId, $productId, $storeId);
    return json_encode(["status" => true]);
  }

  public static function handleRenderCart(){
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $userName = $userInfor->username;
    $CartProducts = Cart::__self__()->getProductFromCart($userName);
    $CartTotalPrice = Cart::__self__()->totalPriceOfCart($userName);
    return parent::render("cart",["productList" => $CartProducts, "cartTotalPrice" => $CartTotalPrice]);
  }

  public static function handleRenderCartModal(){ 
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['result'];
    $userName = $userInfor->username;
    $CartProducts = Cart::__self__()->getProductFromCart($userName);
    $CartTotalPrice = Cart::__self__()->totalPriceOfCart($userName);
    return json_encode(["status" => true, "productList" => $CartProducts, "cartTotalPrice" => $CartTotalPrice]);
  }
}
?>
