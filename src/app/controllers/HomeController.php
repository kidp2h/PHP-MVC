<?php

namespace app\controllers;

use app\models\Banner;
use app\models\Category;

use core\Controller;


class HomeController extends Controller
{
  public static function home()
  {
    $categories = Category::__self__()->getCategoryList();
    $banner = Banner::__self__()->getBanner();

    $params = [
      'name' => $_COOKIE["username"],
      'categories' => $categories,
      'slides' => $banner
    ];



    return parent::render('home', $params);
  }

  public static function PageNotFound()
  {
    Controller::setLayout("");
    return parent::render("404");
  }
}
