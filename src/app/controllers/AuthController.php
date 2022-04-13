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
  public static function signin()
  {
    return parent::render('signin');
  }
  public static function useHook()
  {
    self::$data = ['SITE_KEY' => $_ENV["GC_SITE_KEY"], 'SECRET_KEY' => $_ENV["GC_SECRET_KEY"]];
  }
  public static function handleSignIn(Request $request, Response $response)
  {
    $body = $request->body();
    $result = Utils::verifyCaptcha($body['captcha']);
    if (!$result["success"]) return json_encode(["status" => false, "message" => $result["error-codes"][0]]);
    if (User::__self__()->checkUser($body["username"], $body["password"])) {
      Application::setCookie("username", $body["username"], time() + 3600);
      $response->statusCode(200);
      return json_encode(["status" => true, "redirect" => "/"]);
    }else return json_encode(["status" => false, "message" => "Username or password is wrong"]);
  }
  public static function signup(Request $request)
  {
    return parent::render("signup");
  }

  public static function handleSignUp(Request $request, Response $response)
  {
    $body = $request->body();
    $captcha = Utils::verifyCaptcha($body['captcha']);
    if (!$captcha["success"]) return json_encode(["status" => false, "message" => $captcha["error-codes"][0]]);
    $result = User::__self__()->create([
      "username" => $body["username"],
      "password" => Utils::hashBcrypt($body["password"]),
      "email" => $body["email"],
      "fullName" => $body["fullName"]
    ]);
    if($result["status"]) {
      $response->statusCode(200);
      return json_encode(["status" => true, "redirect" => "/signin"]);
    }else return json_encode(["status" => false, "message" => "Username or email is exist"]);
    // if (User::__self__()->create) {
    //   Application::setCookie("username", $body["username"], time() + 3600);
    //   $response->statusCode(200);
    //   return json_encode(["status" => true, "redirect" => "/"]);
    // }else{
    //   return json_encode(["status" => false, "message" => "Username or password is wrong"]);
    // }
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
