<?php

namespace core;

class View {
  public function checkView($view) {
    return file_exists(Application::$__ROOT_DIR__ . "/app/views/" . $view . ".php");
  }
  public function render($view, $params = [], $paramsLayout = []) {
    $layout = Controller::$layout;
    foreach ($paramsLayout as $key => $value) {
      $$key = $value;
    }
    $viewContent = $this->loadView($view, $params);


    if(!isset($viewContent)){
      $viewContent = "<b>Not Found</b>";
    }
    ob_start();
    include_once Application::$__ROOT_DIR__."/app/views/layouts/$layout.php";
    $layoutContent = ob_get_clean();
    if($layout != "") return str_replace('{{content}}', $viewContent, $layoutContent);
    return $viewContent;
  }
  protected function loadView($view, $params) {
    if (!$this->checkView($view)) {
      return null;
    }
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once Application::$__ROOT_DIR__ . "/app/views/$view.php";
    return ob_get_clean();
  }
}