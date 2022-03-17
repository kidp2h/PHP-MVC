<?php
namespace core;
use core\Application;
require_once Application::$__ROOT_DIR__."/vendor/autoload.php";
require_once Application::$__ROOT_DIR__."/utils/View.php";

class Router {
  protected array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct(Request $request, Response $response) {
    $this->request = $request;
    $this->response = $response;
  }

  public function get($path, $callback){
    $this->routes['GET'][$path] = $callback;
  }
  public function post($path, $callback){
    $this->routes['POST'][$path] = $callback;
  }

  public function render($view, $params = []){
    $layout = $this->loadLayout();
    $view = $this->loadView($view, $params);
    if($view == "404") {
      $this->response->statusCode(404);
      $view = "<b>Not Found View</b>";
    }
    return str_replace("{{content}}", $view, $layout );

  }
  public function loadContent($content){
    $layout = $this->loadLayout();
    return str_replace("{{content}}", $content, $layout );
  }
  protected function loadLayout(){
    $layout = Controller::$layout;
    ob_start();
    include_once Application::$__ROOT_DIR__."/app/views/layout/$layout.php";
    return ob_get_clean();
  }
  protected function loadView($view, $params){
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    if(!checkView($view)){
      return "404";
    }
    include_once Application::$__ROOT_DIR__."/app/views/$view.php";
    return ob_get_clean();

  }

  public function resolve(){
    $path = $this->request->path();
    $method = strtoupper($this->request->method());
    $callback = $this->routes[$method][$path] ?? false;
    if(!$callback){
      $this->response->statusCode(404);
      return $this->loadContent("<b>Not Found</b>");
    }
    if(is_string($callback)) return $this->render($callback);
    return call_user_func($callback, $this->request);
  }
}