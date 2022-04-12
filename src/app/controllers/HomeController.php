<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class HomeController extends Controller {
  public static function home(){
    $params = [
      'name' => $_COOKIE["username"]
    ];
    return parent::render('home',$params);
  }
}

?>