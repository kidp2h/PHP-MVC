<?php

namespace app\controllers;

use core\Controller;
use app\models\Product;
use core\Application;


class ProductController extends Controller
{


  public static function getProductOn50()
  {
    $body = Application::Instance()->request->body();
    if (!isset($body['store'])) $body['store'] = 1;
    if (!isset($body['page'])) $body['page'] = 1;
    $rep = Product::__self__()->getListProductSaleOn50($body['store'], $body['page'], 8);


    echo json_encode($rep);
  }
}