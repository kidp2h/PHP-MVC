<?php
namespace app\middlewares;
use core\Request;
use core\Response;

class AuthMiddleware {
  public static function isAuth(Request $request, Response $response) : callable | bool{
    if(isset($_COOKIE['username'])) return true;
    return fn() => $response->redirect("/login");
  }
  public static function isLogout(Request $request, Response $response) : callable | bool{
    if(!isset($_COOKIE['username'])) return true;
    return fn() => $response->redirect("/");
  }
}