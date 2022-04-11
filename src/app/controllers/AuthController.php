<?php

namespace app\controllers;

use app\validation\RegisterForm;
use core\Controller;
use core\Request;
use app\models\User;
use core\Application;
use core\Response;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookResponse;
use utils\Utils;

class AuthController extends Controller
{
  public static string $layout = "auth";
  public static array $data;
  public static function login()
  {
    return parent::render('login');
  }
  public static function useHook()
  {
    self::$data = ['SITE_KEY' => $_ENV["GC_SITE_KEY"], 'SECRET_KEY' => $_ENV["GC_SECRET_KEY"]];
  }
  public static function handleLogin(Request $request, Response $response)
  {
    $body = $request->body();
    $result = Utils::verifyCaptcha($body['captcha']);
    if (!$result["success"]) return json_encode(["status" => false, "message" => $result["error-codes"][0]]);
    if (User::__self__()->checkUser($body["username"], $body["password"])) {
      Application::setCookie("username", $body["username"], time() + 3600);
      $response->statusCode(200);
      return json_encode(["status" => true, "redirect" => "/"]);
    }
  }

  public static function handleLoginFacebook(Request $request, Response $response)
  {

    //print_r($loginURL);
    exit;
    return "kec";
  }
  public static function register(Request $request)
  {
    return parent::render("register");
  }

  public static function handleRegister(Request $request)
  {
    $data = $request->body();
    $form = RegisterForm::Instance();
    $form->loadData($data);
    $result = $form->validate();
    if (!is_array($result)) {
      return "Success";
    } else {
      parent::setLayout('auth');
      return parent::render("register", [
        'form' => $form
      ]);
    }
  }

  public static function verifyEmail(Request $request)
  {
    header("Content-Type: application/json");
    $id = $request->param("id");
    $hash = $request->param("hash");
    $secretKey = $_ENV["SECRET_KEY"];
    if ($id && $hash) {
      $hashes = explode("__", $hash);
      $user = User::__self__()->read(["email", "isVerified"], "id={$id}");
      if (!$user->isVerified) {
        $mail = $user->email;
        $isCorrect = password_verify($mail, $hashes[0]) && password_verify($secretKey, $hashes[1]);
        ($isCorrect) ? User::__self__()->sendMailVerifyAccount(["address" => $mail]) : null;
      } else return json_encode(["status" => "false", "message" => "This account was verified"]);
    }
  }
}
