<?php

namespace core;
use Error;
class Router {
  protected array $routes = [];
  public Request $request;
  public Response $response;
  private string $prefix;

  public function __construct(Request $request, Response $response) {
    $this->request = $request;
    $this->response = $response;
  }
  public function prefix(string $prefix){
    $this->prefix = $prefix;
  }
  public function __call($name, $arguments){
    $prefix = $this->prefix;
    if($name == "get"){
      switch(count($arguments)){
        case 2:
          $this->routes['GET'][$prefix.$arguments[0]]['callback'] = $arguments[1];
          $this->routes['GET'][$prefix.$arguments[0]]['middleware'] = NULL;
          return;
        case 3:
          $this->routes['GET'][$prefix.$arguments[0]]['callback'] = $arguments[2];
          $this->routes['GET'][$prefix.$arguments[0]]['middleware'] = $arguments[1];
          return;
      }
    }
    if($name == "post"){
      switch(count($arguments)){
        case 2:
          $this->routes['POST'][$prefix.$arguments[0]]['callback'] = $arguments[1];
          $this->routes['POST'][$prefix.$arguments[0]]['middleware'] = NULL;
          return;
        case 3:
          $this->routes['POST'][$prefix.$arguments[0]]['callback'] = $arguments[2];
          $this->routes['POST'][$prefix.$arguments[0]]['middleware'] = $arguments[1];
          return;
      }
    }
  }

  private function getRouteMap($method) : array {
    return $this->routes[$method] ?? [];
  }

  private function getComponentsRoute(){
    $method = $this->request->method();
    $path = $this->request->path();
    $routes = $this->getRouteMap($method);
    $path = trim($path, "/");
    $routeParams = false;
    foreach ($routes as $route => $components) {
      $route = trim($route, '/');
      if (!$route) continue;
      // get name params in route and assign it to $paramNames
      if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) $paramsName = $matches[1];
      // replace {x1:y1} to (y1) 
      $routeRegex = "@^" . preg_replace_callback('/\{\w+:([^}]+)?}/', fn($matches) => isset($matches[1]) ? "({$matches[1]})" : '(\w+)', $route) . "$@";

      if (preg_match_all($routeRegex, $path, $valueMatches)) {
        $values = [];
        // get value in route
        for ($i = 1; $i < count($valueMatches); $i++)
            $values[] = $valueMatches[$i][0];
        // combine value and name param to array
        if(!empty($paramsName) && !empty($values)) $routeParams = array_combine($paramsName, $values);
        // set param for request
        $this->request->setRouteParams($routeParams);
        return ["callback" => $components["callback"], "middleware" => $components["middleware"]];
      }
    }
    return false;
  }
  
  public function resolve() {
    try {
      $path = $this->request->path();
      $method = $this->request->method();
      $componentsRoute = $this->getComponentsRoute();
      $callback = $this->routes[$method][$path]['callback'] ?? $componentsRoute["callback"];
      $middleware = $this->routes[$method][$path]['middleware'] ?? $componentsRoute["middleware"];
      $isPassMiddleware = true;

      if($middleware){
        for ($i = 0; $i < count($middleware); $i++) { 
          $result = call_user_func($middleware[$i],$this->request, $this->response);
          if(is_bool($result)) {
            if(!$result){
              $isPassMiddleware = $result;
              $this->response->statusCode(404);
              break;
            }
          } else return call_user_func($result);
    
        }
        $this->request->isPassedMiddleware = $isPassMiddleware;
      }
      if (!$callback) {
        return Application::$app->response->redirect("/NotFound");
      }
      if (is_string($callback)) return Application::$app->view->render($callback);
      // Hooking
      if(is_callable([$callback[0],'hook'])) call_user_func([$callback[0],'hook']); // Global Hook
      if(is_callable([$callback[0],'useHook'])) call_user_func([$callback[0],'useHook']); // Local Hook
      if(is_callable($callback)){
        return call_user_func($callback, $this->request, $this->response);
      }else {
        throw new Error("Not Found Controller");
      }
  
    } catch (\Throwable $th) {
      echo "<pre>";
      var_dump($th);      
      echo "</pre>";
      exit;
    }
  }
}
