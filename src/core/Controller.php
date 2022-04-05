<?php
namespace core;

class Controller
{
  private static Controller $instance;
  public static string $layout = "main";

  public static function setLayout($layout)
  {
    self::$layout = $layout;
  }
  public static function Instance()
  {
    if (!isset($instance)) $instance = new Controller();
    return $instance;
  }
  public function render($view, $params = [])
  {
    return Application::$app->router->render($view, $params);
  }
}
