<?php
namespace core;
use app\config\Database;
class Application {
  public static string $__ROOT_DIR__;
  public static Application $app;
  public Router $router;
  public Request $request;
  public Response $response;
  public $db;

  public function __construct($rootPath) {
    self::$__ROOT_DIR__ = $rootPath;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->db = Database::Instance()->connect();
    self::$app = $this;
    
  }
  public function run(){

    echo $this->router->resolve();
    
  }
}