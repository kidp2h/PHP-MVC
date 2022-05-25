<?php

namespace app\controllers;

use core\Controller;
use app\models\Product;
use core\Application;


class ProductController extends Controller
{

  public static function getListProductNotHaveStoreId()
  {
    $body = Application::Instance()->request->body();
    $rep = Product::__self__()->getListProductNotHaveStoreId($body['store']);

    echo json_encode($rep);
  }


  public static function getProductOn50()
  {
    $body = Application::Instance()->request->body();
    if (!isset($body['store'])) $body['store'] = 1;
    if (!isset($body['page'])) $body['page'] = 1;
    $rep = Product::__self__()->getListProductSaleOn50($body['store'], $body['page'], 8);


    echo json_encode($rep);
  }

  public static function addProductDetails()
  {
    $body = Application::Instance()->request->body();
    Product::__self__()->AddProductDetails($body['store'], $body['product'], $body['discount'],$body['quantity']);
    
    echo json_encode(["status" => true]);

  }
}