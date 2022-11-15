<?php

namespace app\controllers;

use app\models\Category;
use core\Controller;
use core\Application;
use app\models\Store;
use app\models\Product;

class ShopController extends Controller
{
  public static string $layout = "main";

  public static function shop()
  {
    $body = Application::Instance()->request->body();
    $product = new Product();
    $category = new Category();
    $storeid = 1;

    $category_data = $category->getCategoryListandNum($storeid);
    // $row=$product->getAllProduct();
    $productNum = $category->getSumProductbyStoreId($storeid);
    $currentPage = 1;
    if ($_GET['maxPrice'] == null) {
      $priceTo = 99999;
    } else {
      $priceTo = $_GET['maxPrice'];
    }
    if ($_GET['minPrice'] == null) {
      $priceFrom = 0;
    } else {
      $priceFrom = $_GET['minPrice'];
    }
    $category = "All";
    $title = "";
    $sort = "All";
    if (isset($_GET['sort'])) {
      $sort = $_GET['sort'];
    }
    if (isset($_GET['page'])) {
      $currentPage = $_GET['page'];
    }
    if (isset($_GET['categories'])) {
      $category = $_GET['categories'];
    }
    if (isset($_GET['title'])) {
      $title = $_GET['title'];
    }
    if (!isset($body['store'])) $body['store'] = 1;

    $pageNumber = $product->pageNumber(6, $category, $priceFrom, $priceTo, $title);
    $data_fillter = $product->filterAdvanced($sort, $category, $priceFrom, $priceTo, $title, 6, $currentPage);
    // $data =$product->getListProducts($storeid);
    return parent::render('shop', ["category" => $category_data, "data" => $data_fillter, "pageNumber" => $pageNumber, "NumberProduct" => $productNum]);
  }
}
