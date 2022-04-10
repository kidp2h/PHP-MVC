<?php
namespace app\controllers;
use core\Controller;
use core\Request;
use app\models\Product;

class ShopController extends Controller {
  private static self $instance;
  public static string $layout = "main";
  
  public static function hook(){
    parent::setLayout(self::$layout);
  }

  public static function Instance(){
    if(!isset(self::$instance)) self::$instance = new ShopController();
    return self::$instance;
  }

  public static function shop(){
    return parent::render('shop');
  }

  public static function getProducts($limit=6){
    $product = new Product();
    $PAGE = $product->PageNumber($limit);
    $row= $product->getProducstlist($limit, $PAGE);
    while(!$row){
            
    }
  }
}
?>
     

