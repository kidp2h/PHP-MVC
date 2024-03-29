<?php
namespace app\middlewares;

use app\controllers\AuthController;
use app\models\RequestPending;
use app\models\User;
use core\Application;
use core\Request;
use core\Response;

class AuthMiddleware {
  public static function isAuth(Request $request, Response $response) : callable | bool {
    $result = User::decodeAccessToken($_COOKIE['accessToken']);
    if($result["status"]) return true;
    if($result["error-code"] == 0 && !$result["status"]) {
      $id = $result["id"];
      $user = User::__self__()->findOne(["*"],"id=$id");
      if($user->refreshToken){
        $refreshTokenStatus = User::verifyRefreshToken($user->refreshToken);
        if($refreshTokenStatus){
          AuthController::newAccessToken($_SESSION["id"]);
          return true;
        }else{
          Application::removeCookie("accessToken");
          return fn() => $response->redirect("/signin"); 
        }
      }else {
        Application::removeCookie("accessToken");
        return fn() => $response->redirect("/signin"); 
      }
    }
    Application::removeCookie("accessToken");
    return fn() => $response->redirect("/signin");
  }
  public static function isLogout(Request $request, Response $response) : callable | bool{
    if(!isset($_COOKIE['accessToken'])) return true;
    return fn() => $response->redirect("/");
  }

  public static function isTokenExpire(Request $request, Response $response) : callable | bool {
    $result = User::decodeAccessToken($_COOKIE['accessToken']);
    if($result["status"]) return true;
    if($result["error-code"] == 0 && !$result["status"]) {
      $id = $result["id"];
      $user = User::__self__()->findOne(["*"],"id=$id");
      if($user->refreshToken){
        $refreshTokenStatus = User::verifyRefreshToken($user->refreshToken);
        if($refreshTokenStatus) AuthController::newAccessToken($_SESSION["id"]);
        return true;
      }else {
        Application::removeCookie("accessToken");
        return true;
      }
    }
    Application::removeCookie("accessToken");
    return true;
  }
}