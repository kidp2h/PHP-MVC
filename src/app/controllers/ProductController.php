<?php
namespace app\controllers;
use core\Controller;
use core\Request;
use app\models\Product;
use mysqli;

use function PHPSTORM_META\type;

class ProductController extends Controller {
  private static self $instance;

  public function __construct() {
    parent::setLayout('main');
  }

  public static function Instance(){
    if(!isset(self::$instance)) self::$instance = new ProductController();
    return self::$instance;
  }


  public static function shop(){
    $product = new Product();
    $row=$product->getAllProduct();
    $total=$product->getQuantityProducts();
    $pageNumber=$product->PageNumber();
    $currentPage = 1;
    if(isset($_GET['page'])){
        $currentPage= $_GET['page'];
    }
    $datapage=$product->getProducstlist(6,$currentPage);
    return parent::render('shop',["productlist"=>$row,"total"=>$total,"pageNumber"=>$pageNumber,"currentPage"=>$datapage]);
  }
  public static function getProducts($limit){
    $product = new Product();
    $PAGE = $product->PageNumber($limit);
    $row= $product->getProducstlist($limit, $PAGE);
 
  }
}

?>
     

