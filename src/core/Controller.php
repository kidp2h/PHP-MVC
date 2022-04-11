<?php
namespace core;

class Controller
{
  public static string $layout = "main";
  public static array $data = [];

  public static function setLayout($layout)
  {
    self::$layout = $layout;
  }

  // Global hook
  public static function hook(){
    self::setLayout(static::$layout);
  }
  public static function render($view, $params = [])
  {
    if(!empty(static::$data) && empty($params)) 
      return Application::$app->view->render($view, static::$data);
    return Application::$app->view->render($view, $params);
  }
}
