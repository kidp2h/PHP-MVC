<?php
namespace app\middlewares;

use Closure;
use core\Middleware;
use core\Request;
use core\Response;

class UserMiddleware {
  public static function isAuth(Request $request, Response $response){
    return true;
  }
  public static function isAuth1(Request $request, Response $response){
    return true;
  }
  public static function isAuth2(Request $request, Response $response){
    return false;
  }
}