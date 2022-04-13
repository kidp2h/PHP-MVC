<?php

namespace app\controllers;

use app\models\Category;
use core\Controller;
use core\Request;

class HomeController extends Controller {
  public static function home() {

    $categories = Category::__self__()->getCategoryList();
    $slides = json_decode(
      '
        [
          {
            "id": 1,
            "header": "ai lop diu",
            "title": "abc",
            "desc":"xyz"
          },
          {
            "id": 2,
            "header": "ai lop diu",
            "title": "abc",
            "desc":"xyz"
          },
          {
            "id": 3,
            "header": "ai lop diu",
            "title": "abc",
            "desc":"xyz"
          }
        ]
      '
    );



    $params = [
      'name' => $_COOKIE["username"],
      'categories' => $categories,
      'slides' => $slides
    ];

    return parent::render('home', $params);
  }
}