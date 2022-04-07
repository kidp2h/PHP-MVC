<?php
namespace app\controllers;

use app\validation\RegisterForm;
use core\Controller;
use core\Request;

class AuthController extends Controller {
  public static function login(){
    parent::setLayout('auth');
    return parent::render('login');
  }
  public static function otp(){
    parent::setLayout("auth");
    return parent::render("otp");
  }
  public static function sendOTP(){
    echo "kec";
  }
  public static function register(Request $request){
    if($request->isPassedMiddleware){
      echo "Passing";
    }else{
      echo "Failed";
    }
  }
  // public static function handleRegister(Request $request){
  //   $data = $request->body();
  //   $form = RegisterForm::Instance();
  //   $form->loadData($data);
  //   $result = $form->validate();
  //   if(!is_array($result)){
  //     return "Success";
  //   }else{
  //     self::Instance()->setLayout('auth');
  //     return self::Instance()->render("register",[
  //       'form' => $form
  //     ]);
  //   }
  // }
  public static function handleRegister(Request $request){
    if($request->isPassedMiddleware){
      echo "Passing";
    }else{
      echo "Failed";
    }
  }
}
?>

