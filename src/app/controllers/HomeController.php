<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class HomeController extends Controller {
  public static function home(){
    $params = [
      'name' => "KidP2H"
    ];
    return parent::render('home',$params);
  }
}
?>