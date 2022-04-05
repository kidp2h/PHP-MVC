<?php
namespace app\middlewares;

use Closure;
use core\Middleware;
use core\Request;
use core\Response;

class UserMiddleware {
  public static function isAuth(Request $request, Response $response, bool $next = false){
    echo "x";
    if(true){  
      return $next;
    }else {
      return false;
    }
  }
  public static function isAuth1(Request $request, Response $response, bool $next = false){
    echo "y";
    if(true){
      return $next;
    }else {
      return false;
    }
  }
  public static function isAuth2(Request $request, Response $response, bool $next = false){
    echo "z";
    if(true){
      return $next;
    }else {
      return false;
    }
  }
}