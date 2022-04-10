<?php 
namespace core;
use core\Session;

  class Request {
    private array $routeParams = [];
    public Session $session;
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
          $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
      }
      return $body;
    }

    public function isMethod($method){
      return $this->method() === strtoupper($method);
    }

    public function param($param){
      return $this->routeParams[$param] ?? null;
    }

    public function params(){
      return $this->routeParams;
    }

    public function setRouteParams($params){
      if(is_array($params)) $this->routeParams = $params;
      
    }

    public function session(){
      return true;
    }

    public function setSession($key, $value){
      $_SESSION[$key] = $value;
    }
  }
