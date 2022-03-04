<?php
namespace app\controllers;

use app\validation\RegisterForm;
use core\Controller;
use core\Request;

class AuthController extends Controller {

  public static function login(){
    Controller::Instance()->setLayout('auth');
    return Controller::Instance()->render('login');
  }
  public static function register(){
    Controller::Instance()->setLayout('auth');
    return Controller::Instance()->render("register");
  }
  public static function handleRegister(Request $request){
    $rules = RegisterForm::Instance()->rules();
    RegisterForm::Instance()->loadData($request->body());
    $result = RegisterForm::Instance()->validate();
    echo '<pre>';
    var_dump($result);
    echo '</pre>';
    exit;
  }
}
?>