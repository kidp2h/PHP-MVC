<?php
use core\Application;
  function checkView($view){
    return file_exists(Application::$__ROOT_DIR__."/app/views/".$view.".php");
  }
?>