<?php
namespace core;

class Controller {
  public static string $layout = 'main';
  public static array $params = [];
  public static array $paramsLayout = [];

  public static function setLayout(string $layout) {
    self::$layout = $layout;
  }

  // Global hook
  public static function hook() {
    self::setLayout(static::$layout);
  }

  public static function render($view, $params = [], $paramsLayout = []) {
    try {
      // handle params optional or params in hook controller
      $params = array_merge(static::$params, $params);
      $paramsLayout = array_merge(static::$paramsLayout,  $paramsLayout);
      return Application::$app->view->render(
        $view,
        $params,
        $paramsLayout
      );
    } catch (\Throwable $th) {
      var_dump($th);
    }

  }
}
