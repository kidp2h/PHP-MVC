<?php 
namespace core;
class Session {
  public function __construct() {
    session_start();
  }
  public function set($key, $value){
    $_SESSION[$key] = $value;
  }

  public function get($key) {
    return $_SESSION[$key] ?? false;
  }
  public function remove($key) {
    unset($_SESSION[$key]);
  }

  public function __destruct()
  {
    session_destroy();
  }
}

?>