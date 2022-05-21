<?php
namespace app\middlewares;

use app\controllers\AuthController;
use app\models\RequestPending;
use app\models\User;
use core\Request;
use core\Response;

class AuthMiddleware {
  public static function isAuth(Request $request, Response $response) : callable | bool {
    $result = User::decodeAccessToken($_COOKIE['accessToken']);
    
    if($result["status"]) return true;
    if($result["error-code"] == 0 && !$result["status"]) {
      AuthController::newAccessToken($_SESSION["id"]);
      return true;
    } 
    return fn() => $response->redirect("/signin");
  }
  public static function isLogout(Request $request, Response $response) : callable | bool{
    if(!isset($_COOKIE['accessToken'])) return true;
    return fn() => $response->redirect("/");
  }
  public static function isTokenReset(Request $request, Response $response) : callable | bool {
    
    $tokenReset = urldecode($request->param("tokenReset") ?? ($request->body())["tokenReset"]);
    $requestPending = RequestPending::__self__()->read(["*"],"token='$tokenReset'");
    if($requestPending){
      return true;
    }
    return fn() => $response->redirect("/signin");
  }
  public static function isTokenExpire(Request $request, Response $response) : callable | bool {
    $result = User::decodeAccessToken($_COOKIE['accessToken']);
    if($result["error-code"] == 0 && !$result["status"]) {
      AuthController::newAccessToken($_SESSION["id"]);
    }
    return true;
  }
}
