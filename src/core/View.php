<?php

namespace core;

use core\Application;

class View {
  private static View $instance;

  public static function Instance() {
    if (!isset($instance)) $instance = new View();
    return $instance;
  }
  public function checkView($view) {
    return file_exists(Application::$__ROOT_DIR__ . "/app/views/" . $view . ".php");
  }
}
