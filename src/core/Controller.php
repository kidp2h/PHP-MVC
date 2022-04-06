<?php
namespace core;

class Controller
{
  public static string $layout = "main";

  public static function setLayout($layout)
  {
    self::$layout = $layout;
  }
  public static function render($view, $params = [])
  {
    return Application::$app->view->render($view, $params);
  }
}
