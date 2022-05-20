<?php

namespace app\controllers;

use app\models\Category;
use app\models\Store;
use app\models\User;
use core\Application;
use core\Controller;


class HomeController extends Controller
{
  public static array $paramsLayout = ["title" => "Home"];
  public static function home()
  {
    $user = null;
    if(isset($_COOKIE["accessToken"])){
      $result = User::__self__()->decodeAccessToken($_COOKIE["accessToken"]);
      if($result["status"]){
        $user = $result["user"];

      }
    } 
    $body = Application::Instance()->request->body();
    if (!isset($body['store'])) $body['store'] = 1;
    $params = [
      'user' => $user
    ];
    $paramsLayout = ['user' => $user];
    
    return parent::render('home', $params, $paramsLayout);
  }

  public static function PageNotFound(){
    Controller::setLayout("");
    return parent::render("404");
  }
}
