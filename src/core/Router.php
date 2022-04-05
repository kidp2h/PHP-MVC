<?php

namespace core;

use app\middlewares\UserMiddleware;
use core\Application;
use core\View;

class Router {
  protected array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct(Request $request, Response $response) {
    $this->request = $request;
    $this->response = $response;
  }
  public function __call($name, $arguments){
    if($name == "get"){
      switch(count($arguments)){
        case 2:
          $this->routes['GET'][$arguments[0]]['callback'] = $arguments[1];
          $this->routes['GET'][$arguments[0]]['middleware'] = NULL;
          return;
        case 3:
          $this->routes['GET'][$arguments[0]]['callback'] = $arguments[2];
          $this->routes['GET'][$arguments[0]]['middleware'] = $arguments[1];
          return;
      }
      if($name == "post"){
        switch(count($arguments)){
          case 2:
            $this->routes['POST'][$arguments[0]]['callback'] = $arguments[1];
            $this->routes['POST'][$arguments[0]]['middleware'] = NULL;
            return;
          case 3:
            $this->routes['POST'][$arguments[0]]['callback'] = $arguments[2];
            $this->routes['POST'][$arguments[0]]['middleware'] = $arguments[1];
            return;
        }
      }
    }
  }

  public function getRouteMap($method) : array {
    return $this->routes[$method] ?? [];
  }

  public function getCallback(){
    $method = $this->request->method();
    $path = $this->request->path();
    $routes = $this->getRouteMap($method);
    $path = trim($path, "/");
    $routeParams = false;
    foreach ($routes as $route => $components) {
      $route = trim($route, '/');
      $routeNames = [];
      if (!$route) continue;

      if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) $routeNames = $matches[1];

      $routeRegex = "@^" . preg_replace_callback('/\{\w+:([^}]+)?}/', fn($m) => isset($m[1]) ? "({$m[1]})" : '(\w+)', $route) . "$@";
      if (preg_match_all($routeRegex, $path, $valueMatches)) {
          $values = [];
          for ($i = 1; $i < count($valueMatches); $i++)
              $values[] = $valueMatches[$i][0];
          $routeParams = array_combine($routeNames, $values);
          $this->request->setRouteParams($routeParams);
          return $components["callback"];
      }
  }

  return false;
  }

  public function render($view, $params = []) {
    $layout = $this->loadLayout();
    $view = $this->loadView($view, $params);
    if ($view == "404") {
      $this->response->statusCode(404);
      $view = "<b>Not Found View</b>";
    }
    return str_replace("{{content}}", $view, $layout);
  }
  public function loadContent($content) {
    $layout = $this->loadLayout();
    return str_replace("{{content}}", $content, $layout);
  }
  protected function loadLayout() {
    $layout = Controller::$layout;
    ob_start();
    include_once Application::$__ROOT_DIR__ . "/app/views/layout/$layout.php";
    return ob_get_clean();
  }
  protected function loadView($view, $params) {
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    if (!View::Instance()->checkView($view)) {
      return "404";
    }
    include_once Application::$__ROOT_DIR__ . "/app/views/$view.php";
    return ob_get_clean();
  }
  public function resolve() {
    $path = $this->request->path();
    $method = $this->request->method();
    $callback = $this->routes[$method][$path]['callback'] ?? false;
    $middleware = $this->routes[$method][$path]['middleware'];
    if(count($middleware) == 1){
      return call_user_func($middleware[0],$this->request, $this->response);
    }
    if(count($middleware) > 1){
      $next = true;
      for ($i = 0; $i < count($middleware); $i++) { 
        $result = call_user_func($middleware[$i],$this->request, $this->response,$next);
        if(!$result) {
         $next = false;
         return $result; 
        }
      }
    }
    
    // if(count($middleware) == 1) return call_user_func($middleware[0],$this->request);
    // for ($i = 0; $i <= count($middleware) - 1; $i++) { 
    //   $result = call_user_func($middleware[$i+1],$this->request, $middleware[$i + 1]);
    //   if(!is_callable($result)) return false;
      
    // }
    exit;
    if(!$callback){
      $callback = $this->getCallback();
      if ($callback === false) {
        $this->response->statusCode(404);
        return $this->loadContent("<b>Not Found</b>"); 
      }
    }
    if (is_string($callback)) return $this->render($callback);
    return call_user_func($callback, $this->request);
  }
}
