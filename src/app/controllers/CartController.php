<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\Cart;
use app\models\Product;
use app\models\User;

class CartController extends Controller {
  public static string $layout = "main";

  public static function handleAddToCart(Request $request) {
    if(empty($_COOKIE["accessToken"])) {
      return json_encode(["status" => false]);
    }
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result["user"];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];
    $quantity = $body['amount'];

    $cartItem = Cart::__self__()->getCartByUserId($userId);
    $addedProduct = Product::__self__()->getProductByIdAndStore($productId);

    $isFind = false;
    for ($i=0; $i < count($cartItem); $i++) { 
        if($cartItem[$i]['product_id'] == $productId ) {
            $isFind = true;
            $quantity += (int)$cartItem[$i]['quantity'];
            Cart::__self__()->updateProductToCart($userId, $productId, $quantity);
        } 
    }
    if(!$isFind) {
      Cart::__self__()->addProductToCart($userId, $productId, $quantity);
    }

    return json_encode(["status" => true, "product" => $addedProduct, "cartItem" => $cartItem]);
  }

  public static function handleUpdateToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['user'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];
    $amount = $body['amount'];

    Cart::__self__()->updateProductToCart($userId, $productId, $amount);
    return json_encode(["status" => true]);
  }

  public static function handleDeleteToCart(Request $request) {
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['user'];
    $body = $request->body();
    $userId = $userInfor->id;
    $productId = $body['productId'];

    Cart::__self__()->deleteProductFromCart($userId, $productId);
    return json_encode(["status" => true]);
  }

  public static function handleRenderCart(){
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['user'];
    $id = $userInfor->id;
    $CartProducts = Cart::__self__()->getProductFromCart($id);
    $CartTotalPrice = Cart::__self__()->totalPriceOfCart($id);
    return parent::render("cart",["productList" => $CartProducts, "cartTotalPrice" => $CartTotalPrice]);
  }

  public static function handleRenderCartModal(){ 
    $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
    $userInfor = $result['user'];
    $id = $userInfor->id;
    $CartProducts = Cart::__self__()->getProductFromCart($id);
    $CartTotalPrice = Cart::__self__()->totalPriceOfCart($id);
    return json_encode(["status" => true, "productList" => $CartProducts, "cartTotalPrice" => $CartTotalPrice]);
  }
}
