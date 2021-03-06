<?php

namespace app\controllers;

use app\models\Category;
use app\models\Store;

use core\Application;
use core\Controller;


class HomeController extends Controller
{
  public static function home()
  {
    $body = Application::Instance()->request->body();
    if (!isset($body['store'])) $body['store'] = 1;
    $categories = Category::__self__()->getCategoryListByStore($body['store']);
    $stores = Store::__self__()->getStoreList();
    $banner = Store::__self__()->getBannerStore($body['store']);



    $params = [
      'name' => $_COOKIE["username"],
      'categories' => $categories,
      'slides' => $banner
    ];



    $paramsLayout = ['storeCurrent' => $body['store'], 'stores' => $stores];

    return parent::render('home', $params, $paramsLayout);
  }

  public static function PageNotFound(){
    Controller::setLayout("");
    return parent::render("404");
  }
}