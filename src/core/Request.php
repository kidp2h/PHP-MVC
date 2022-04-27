<?php 
namespace core;
use core\Session;

class Request {
  private array $routeParams = [];
  public bool $isPassedMiddleware;
  public function path(){
    return $_SERVER['REDIRECT_URL'];
  }
  public function method(){
    return strtoupper($_SERVER["REQUEST_METHOD"]);
  }
  public function body(){
    $body = [];
    if($this->method() === "GET"){
      foreach ($_GET as $key => $value) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }
    if($this->method() === "POST"){
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key);
      }
    }
    return $body;
  }
  public function isMethod(string $method) : bool{
    return $this->method() === strtoupper($method);
  }
  public function param(string $param) : string | null {
    return $this->routeParams[$param] ?? null;
  }
  public function params(){
    return $this->routeParams;
  }
  public function setRouteParams($params){
    if(is_array($params)) $this->routeParams = $params;
  }
}
