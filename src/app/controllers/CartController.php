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
    if(!isset($_SESSION["username"])) die();
    $Cart = new Cart();
    $User = new User();
    $body = $request->body();
    $userName = $_COOKIE["username"];
    $productId = $body['productId'];
    $amount = $body['amount'];
    $user = $User->getUserByUsername($userName);
    $userId = $user['id'];

    $cartItem = $Cart->getCartByUserId($userId);

    $isFind = false;
    for ($i=0; $i < count($cartItem); $i++) { 
        if($cartItem[$i]['product_id'] == $productId) {
            $isFind = true;
            $amount += (int)$cartItem[$i]['quantity'];
            $Cart->updateProductToCart($userId, $productId, $amount);
        } 
    }
    if(!$isFind) {
      $Cart->addProductToCart($userId, $productId, $amount);
    }

    return json_encode(["status" => true]);
  }

  public static function handleUpdateToCart(Request $request, Response $response) {
    //$userId = User::decodeAccessToken($accessToken);
    //...
    return json_encode(["status" => true]);
  }

  public static function handleRenderCart(){
    if(!isset($_COOKIE["username"])) die();
    $Cart = new Cart();
    $userName = $_COOKIE["username"];
    $CartProducts = $Cart->getProductFromCart($userName);
    return parent::render("cart",["productList" => $CartProducts]);
  }
}
?>
