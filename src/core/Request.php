<?php 
  namespace core;
  class Request {
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
  }
