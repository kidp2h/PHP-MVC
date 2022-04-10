<?php
namespace app\controllers;

use app\validation\RegisterForm;
use core\Controller;
use core\Request;
use app\models\User;
use core\Response;

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
    return parent::render("register",['SITE_KEY' => $_ENV["GC_SITE_KEY"],'SECRET_KEY' => $_ENV["GC_SECRET_KEY"]]);
  }
  public static function verifyEmail(Request $request){
    header("Content-Type: application/json");
    $id = $request->param("id");
    $hash = $request->param("hash");
    $secretKey = $_ENV["SECRET_KEY"];
    if($id && $hash){
      $hashes = explode("__",$hash);
      $user = User::__self__()->read(["email", "isVerified"],"id={$id}");
      if(!$user->isVerified){
        $mail = $user->email;
        $isCorrect = password_verify($mail,$hashes[0]) && password_verify($mail,$hashes[1]);
        ($isCorrect) ? User::__self__()->sendMailVerifyAccount(["address" => $mail]) : null;
      }else return json_encode(["status" => "false","message" => "This account was verified"]);
    }
    
  }

  public static function handleLogin(Request $request, Response $response){

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