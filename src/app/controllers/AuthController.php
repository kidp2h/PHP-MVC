<?php
namespace app\controllers;

use app\validation\RegisterForm;
use core\Controller;
use core\Request;

class AuthController extends Controller {
  public static function login(){
    self::Instance()->setLayout('auth');
    return self::Instance()->render('login');
  }
  public static function otp(){
    self::Instance()->setLayout("auth");
    return self::Instance()->render("otp");
  }
  public static function sendOTP(){
    echo "kec";
  }
  public static function register(){
    self::Instance()->setLayout('auth');
    return self::Instance()->render("register");
  }
  public static function handleRegister(Request $request){
    $data = $request->body();
    $form = RegisterForm::Instance();
    $form->loadData($data);
    $result = $form->validate();
    if(!is_array($result)){
      return "Success";
    }else{
      self::Instance()->setLayout('auth');
      return self::Instance()->render("register",[
        'form' => $form
      ]);
    }

  }
}
?>