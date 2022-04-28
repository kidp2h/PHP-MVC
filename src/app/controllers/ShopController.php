<?php

namespace app\controllers;
use app\models\Category;
use core\Controller;
use core\Application;
use app\models\Store;
use app\models\Product;

class ShopController extends Controller {
  public static string $layout = "main";

  public static function shop() {
    $body = Application::Instance()->request->body();
    $product = new Product();
    $category = new Category();
    $category_data = $category->getCategoryList();
    // $row=$product->getAllProduct();
    
    $currentPage = 1;
    $priceTo=99999;
    $category="All";
    $priceFrom=0;
    $title= "";
    $sort="All";
    $storeid=1;
    if(isset($_GET['store'])){
      $storeid=$_GET['store'];
    }
    if(isset($_GET['sort'])){
      $sort=$_GET['sort'];
    }
    if(isset($_GET['page'])){
        $currentPage= $_GET['page'];
    }
    if(isset($_GET['categories'])){
      $category= $_GET['categories'];}
    if(isset($_GET['minPrice'])){
      $priceFrom = $_GET['minPrice'];} 
    if(isset($_GET['maxPrice'])){
      $priceTo =$_GET['maxPrice'];}
    if(isset($_GET['title'])){
      $title = $_GET['title'];}
      if(!isset($body['store'])) $body['store'] = 1;
      $stores = Store::__self__()->getStoreList();
      $paramsLayout = [ 'storeCurrent' => $body['store'], 'stores' => $stores];
      
     $pageNumber=$product->pageNumber($storeid,6,$category,$priceFrom,$priceTo,$title);
     $data_fillter=$product->filterAdvanced($storeid, $sort,$category,$priceFrom,$priceTo,$title,6,$currentPage);
      // $data =$product->getListProducts($storeid);
    return parent::render('shop',['storeCurrent' => $body['store'],"category"=>$category_data, "data"=>$data_fillter,"pageNumber"=>$pageNumber],$paramsLayout);
  }

}