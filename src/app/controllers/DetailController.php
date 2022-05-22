<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\Product;

class DetailController extends Controller {
  public static string $layout = "main";
  
  public static function handleDetail(Request $request){
    $product = new Product();
    $id = $request->param("id");
    $store = $request->param("store");
    $productById = $product->getProductByIdAndStore($id, $store);
    $randomProduct = $product->randomProduct();
    return parent::render("detail",["product" => $productById,"randomProduct" => $randomProduct]);
  }
}
?>
