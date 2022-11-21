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
  public static array $paramsLayout = [];
  public static ?User $userModel = NULL;
  public static function signin() {
    return parent::render('signin', [], ["title" => "Sign In"]);
  }
  public static function useHook() {
    self::$userModel = User::__self__();
    self::$params = ['SITE_KEY' => $_ENV["GC_SITE_KEY"], 'SECRET_KEY' => $_ENV["GC_SECRET_KEY"]];
  }
  public static function handleSignIn(Request $request, Response $response) {
    $body = $request->body();
    $result = self::$userModel->checkUser($body["username"], $body["password"]);
    if ($result->status) {
      try {
        User::applyRefreshToken($result->user->id);
        $data = User::newAccessToken($result->user->id);
        Application::setCookie("accessToken", $data["accessToken"], time() + 3600);
      } catch (\Throwable $th) {
      }

      $response->statusCode(200);
      return json_encode(["status" => true, "redirect" => "/"]);
    } else return json_encode(["status" => false, "message" => "Username or password is wrong"]);
  }
  public static function signup(Request $request) {
    return parent::render("signup", [], ["title" => "Sign Up"]);
  }


  public static function handleSignUp(Request $request, Response $response) {
    $body = $request->body();
    $token = Utils::v4();
    $result = self::$userModel->create([
      "username" => $body["username"],
      "password" => Utils::hashBcrypt($body["password"]),
      "email" => $body["email"],
      "fullName" => $body["fullName"],
      "tokenVerify" => $token

    ]);
    if ($result->status) {
      $response->statusCode(200);
      return json_encode(["status" => true, "redirect" => "/signin"]);
    } else return json_encode(["status" => false, "message" => "Username or email is exist"]);
  }


  public static function newAccessToken(int $id) {
    $result = User::newAccessToken($id);
    Application::$user = $result["user"];
    Application::setCookie("accessToken", $result["accessToken"], time() + 2147483647);
  }

  public static function logout(Request $request, Response $response) {
    setcookie('accessToken', null, -1, '/');
    unset($_SESSION["id"]);
    return $response->redirect("/signin");
  }


  public static function getAccessToken() {
    $result = User::newAccessToken($_POST["id"]);

    return json_encode($result);
  }
  public static function verifyAccessToken() {
    $accessToken = $_POST["accessToken"];
    $resultDecode = User::decodeAccessToken($accessToken);
    if (!$resultDecode["status"])
      return json_encode($resultDecode);
    return json_encode($resultDecode);
  }
  public static function verifyRefreshToken() {
    $refreshToken = $_POST["refreshToken"];
    $resultDecode = User::verifyRefreshToken($refreshToken);
    if ($resultDecode)
      return json_encode(["status" => true]);
    return json_encode(["status" => $resultDecode["status"], "message" => $resultDecode[""]]);
  }
  public static function handleVerifyAccount(Request $request, Response $response) {
    $tokenVerify = $request->param("token");
    $result = User::__self__()->findOne(["*"], "tokenVerify='$tokenVerify'");
    if ($result) {
      User::__self__()->update(["isVerified" => 1], "tokenVerify='$tokenVerify'");
      $response->redirect("/signin");
    } else {
      parent::$layout = "";
      return parent::render("404");
    }
  }

  public static function handleSaveChanges(Request $request, Response $response) {
    $body = $request->body();
    $user = Application::$user;
    $id = $user->id;
    $arraySet = [];
    foreach ($body as $key => $value) {
      if ($value !== "" && $value !== $user->$key) {

        if ($key == "password") {
          $arraySet[$key] = Utils::hashBcrypt($value);
        } else {
          $arraySet[$key] = $value;
        }
      }
    }
    if (count($arraySet) > 0) {
      $result = User::__self__()->update($arraySet, "id=$id");
      self::newAccessToken($id);
      if ($result) return json_encode(["status" => true, "message" => "Update information successfully !!"]);
      return json_encode(["status" => false, "message" => "Phone number is exist"]);
    } else {
      return json_encode(["status" => false, "message" => false]);
    }
  }
}
