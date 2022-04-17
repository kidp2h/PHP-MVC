<?php
namespace app\controllers;

use app\models\Category;
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
    $category = new Category();
    $category_data = $category->getCategoryList();
    // $row=$product->getAllProduct();
    
    $currentPage = 1;
    $priceTo=9999;
    $category="All";
    $priceFrom=0;
    $title= "";
    if(isset($_GET['page'])){
        $currentPage= $_GET['page'];
    }
    if(isset($_GET['categories'])){
      $category= $_GET['categories'];}
    if(isset($_GET['Min-price'])){
      $priceFrom = $_GET['Min-price'];} 
    if(isset($_GET['Max-price'])){
      $priceTo =$_GET['Max-price'];  }
    if(isset($_GET['title'])){
      $title = $_GET['title'];}
    $pageNumber=$product->pageNumber(6,$category,$priceFrom,$priceTo,$title);
    $data_fillter=$product->filterAdvanced($category,$priceFrom,$priceTo,$title,6,$currentPage);
    
    return parent::render('shop',["category"=>$category_data,"data"=>$data_fillter,"pageNumber"=>$pageNumber]);
  }

}

?>
     

