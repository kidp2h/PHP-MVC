<?php
namespace app\controllers;
use core\Controller;
use core\Request;
use app\models\Product;
use mysqli;

use function PHPSTORM_META\type;

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
    $product = new Product();
    // $row=$product->getAllProduct();
    $pageNumber=$product->pageNumber(6);
    $currentPage = 1;
    if(!isset($_GET['page'])){
        $currentPage= $_GET['page'];
    }
    $datapage=$product->getListProducts(6,$currentPage);
    return parent::render('shop',["pageNumber"=>$pageNumber,"currentPage"=>$datapage]);
  }

}

?>
     

