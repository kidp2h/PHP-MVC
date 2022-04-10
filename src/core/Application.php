<?php

namespace core;
use database\Database;
use Dotenv\Dotenv;
use SendGrid\Mail\Mail;


class Application {
  private static self $instance;
  public static string $__ROOT_DIR__;
  public static Application $app;
  public string $layout = "main";
  public Router $router;
  public ?Controller $controller = null;
  public Request $request;
  public Response $response;
  public View $view;
  public Model $model;
  public static Mail $mail;
  public $db;

  public function __construct($rootPath) {
    session_start();
    $dotenv = Dotenv::createImmutable($rootPath);
    $dotenv->load();
    self::$__ROOT_DIR__ = $rootPath;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->db = Database::Instance()->connect();
    $this->model = new Model();
    $this->view = new View();
    $this->controller = new Controller();
    self::$mail = new Mail();
    self::$app = $this;
  }

  public static function Instance(){
    if(!isset(self::$instance)) self::$instance = new Application(dirname(__DIR__));
    return self::$instance;
  }
  public function run() {
    echo $this->router->resolve();
  }
}
