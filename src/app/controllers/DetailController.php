<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\Product;

class DetailController extends Controller {
  private static self $instance;
  public static string $layout = "main";
  
  public static function hook(){
    parent::setLayout(self::$layout);
  }

  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new DetailController();
    }
    return self::$instance;
  }
  
  public static function handleDetail(Request $request){
    $product = new Product();
    $id = $request->param("id");
    $productById = $product->getProductById($id);
    $randomProduct = $product->randomProduct();
    return parent::render("detail",["product" => $productById,"randomProduct" => $randomProduct]);
  }
}
?>
