<?php
namespace app\controllers;

use core\Controller;
use core\Request;
use app\models\User;

class UserController extends Controller {
  public static function getUser(Request $request){
    header('Content-Type: application/json; charset=utf-8');
    $body = $request->body();
    if(!empty($body) && array_key_exists("id",$body)){
      $id = $body["id"];
      $user = User::__self__()->read(["id", "username","password"],"id={$id}");
      echo json_encode($user,JSON_PRETTY_PRINT);
    }
  }
  public static function sendOTP(Request $request){
    $phoneNumber = $request->param("phone");
    if(!isset($body)){
      User::__self__()->sendCodeOTP($phoneNumber);
    }
  }

}