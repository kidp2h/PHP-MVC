<?php

namespace app\controllers;

use app\models\RequestPending;
use core\Controller;
use core\Request;
use app\models\User;
use core\Application;
use core\Response;
use utils\Utils;

class AuthController extends Controller {
  public static string $layout = "auth";
  public static array $params = [];
  public static array $paramsLayout = ["title" => "Sign In"];
  public static function signin() {
    return parent::render('signin');
  }
  public static function useHook() {
    self::$params = ['SITE_KEY' => $_ENV["GC_SITE_KEY"], 'SECRET_KEY' => $_ENV["GC_SECRET_KEY"]];
  }
  public static function handleSignIn(Request $request, Response $response) {
    $body = $request->body();
    $result = Utils::verifyCaptcha($body['captcha']);
    if (!$result["success"]) return json_encode(["status" => false, "message" => $result["error-codes"][0]]);
    $result = User::__self__()->checkUser($body["username"], $body["password"]);
    if ($result->status) {
      if(!$result->user->isVerified){
        return json_encode(["status" => false, "message" => "Account isn't verified email"]);
      }
      User::applyRefreshToken($result->user->id);
      $data = User::newAccessToken($result->user->id);
      Application::setCookie("accessToken", $data["accessToken"], time() + 3600);

      $response->statusCode(200);
      return json_encode(["status" => true, "redirect" => "/"]);
    } else return json_encode(["status" => false, "message" => "Username or password is wrong"]);
  }
  public static function signup(Request $request) {
    self::$paramsLayout = ["title" => "Sign Up"];
    return parent::render("signup");
  }

  public static function handleOAuth(Request $request, Response $response){
    $body = $request->body();
    $user = User::__self__()->getUserByUsername($body["username"]);
    if(!isset($user->id)){
      $user = User::__self__()->create([
        "username" => $body["username"],
        "password" => Utils::hashBcrypt(rand(1000000000,9999999999)),
        "email" => $body["email"],
        "fullName" => $body["fullName"],
        "isVerified" => 1
      ]);
    }
    self::newAccessToken((int)$user->id);
    return json_encode(["status" => true, "redirect" => "/"]);

  }

  public static function handleSignUp(Request $request, Response $response) {
    $body = $request->body();
    $captcha = Utils::verifyCaptcha($body['captcha']);
    if (!$captcha["success"]) return json_encode(["status" => false, "message" => $captcha["error-codes"][0]]);
    $result = User::__self__()->create([
      "username" => $body["username"],
      "password" => Utils::hashBcrypt($body["password"]),
      "email" => $body["email"],
      "fullName" => $body["fullName"]
    ]);
    if($result->status) {
      $response->statusCode(200);
      User::sendMailVerifyAccount(["address" => $body["email"]]);
      return json_encode(["status" => true, "redirect" => "/signin", "message" => "Please check your inbox to verify account"]);
    }else return json_encode(["status" => false, "message" => "Username or email is exist"]);
  }

  public static function verifyEmail(Request $request) {
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

  public static function newAccessToken(int $id){
    $accessToken = User::newAccessToken($id)["accessToken"];
    Application::setCookie("accessToken", $accessToken, time() + 3600);
  }

  public static function logout(Request $request, Response $response){
    setcookie('accessToken', null, -1, '/'); 
    unset($_SESSION["id"]);
    return $response->redirect("/signin");
  }

  public static function resetPassword(Request $request, Response $response) {
    return parent::render("resetPassword",["tokenReset" => $request->param("tokenReset")]);
  }
  public static function handleResetPassword(Request $request, Response $response) {
    try {
      $body = $request->body();
      $tokenReset = $body["tokenReset"];
      $newPassword = $body["newPassword"];
      $confirmNewPassword = $body["confirmNewPassword"];
      if(!empty($newPassword) && !empty($confirmNewPassword) && $newPassword == $confirmNewPassword){
        $resultToken = User::decodeTokenReset($tokenReset);
        if($resultToken["status"]){
          // TODO: update new password
          $id = $resultToken["user"]->id;
          $newPassword = Utils::hashBcrypt($newPassword);
          $result = User::__self__()->update(["password" => $newPassword],"id=$id");
          if($result) {
            RequestPending::__self__()->delete("token='$tokenReset'");
            return json_encode(["status" => true, "message" => "Change password successfully, sign up now !!", "redirect" => "/signin"]);
          }
        }else return json_encode(["status" => false, "message" => "Token error, please contact to developer"]);
      }
      return json_encode(["status" => false, "message" => "Not found"]);
    } catch (\Throwable $th) {
      var_dump($th);
    }


  }
  public static function forgotPassword(Request $request, Response $response){
    self::$paramsLayout = ["title" => "Forgot Password"];
    return parent::render("forgotPassword");
  }
  public static function handleForgotPassword(Request $request, Response $response){
    $body = $request->body();
    $email = $body["email"];
    $captcha = Utils::verifyCaptcha($body['captcha']);
    if (!$captcha["success"]) return json_encode(["status" => false, "message" => $captcha["error-codes"][0]]);
    $user = User::__self__()->read(["*"], "email='$email'");
    if($user){
      $token = '';
      $_request = RequestPending::__self__()->read(["*"],"email='$email'");
      $resultToken = User::__self__()->getTokenReset($email);
      if(!$resultToken["status"]) return $response->redirect("/signin");
      $token = $resultToken["tokenReset"];
      if($_request) RequestPending::updateRequest($email, $_request->token, $token);
      else RequestPending::createRequest($email, $token);
      User::sendMailResetPassword(["address" => $email], $token);
      return json_encode(["status" => true, "message" => "Please check mail to reset password" ]);
    } else return json_encode(["status" => false, "message" => "Email isn't valid, please try again !" ]);
  }
  public static function getTokenReset(Request $request, Response $response){
    var_dump(User::getTokenReset("thjnhsoajca@gmail.com"));
  }
  public static function verifyTokenReset(Request $request, Response $response) {
    $tokenReset = $_POST["tokenReset"];
    var_dump(User::decodeTokenReset($tokenReset));
  }
  
  public static function sendOTP(Request $request, Response $response){
    $phone = ($request->body())['phoneNumber'];
    $result = Utils::createNewOTP($phone);
    return json_encode($result);
  }
  public static function verifyOTP(Request $request, Response $response){
    $otp = ($request->body())['otp'];
    $payload = Application::$app->getCookie('payload');
    $payload = explode(".",$payload);
    $hash = "$payload[0].$payload[1]";
    $phone = $payload[2];
    $result = Utils::verifyOTP($phone,$hash,$otp);
    if($result){
      User::__self__()->update(["isActivePhone" => 1],"phoneNumber='$phone'");
    }
    return json_encode(["status" => $result]);
  }   
  public static function getAccessToken(){
    $result = User::newAccessToken($_POST["id"]);
    
    return json_encode($result);
  }
  public static function verifyAccessToken(){
    $accessToken = $_POST["accessToken"];
    $resultDecode = User::decodeAccessToken($accessToken);
    if(!$resultDecode["status"])
      return json_encode($resultDecode);
    return json_encode($resultDecode);
  }
  public static function verifyRefreshToken(){
    $refreshToken = $_POST["refreshToken"];
    $resultDecode = User::verifyRefreshToken($refreshToken);
    if($resultDecode)
      return json_encode(["status" => true]);
    return json_encode(["status" => $resultDecode["status"], "message" => $resultDecode[""]]);   
  }
}