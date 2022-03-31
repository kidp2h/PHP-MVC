<?php

namespace core;

use app\config\Database;
// use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;
use SendGrid\Mail\Mail;

class Application {
  public static string $__ROOT_DIR__;
  public static Application $app;
  public Router $router;
  public Request $request;
  public Response $response;
  public Model $model;
  public static Mail $mail;
  public $db;

  public function __construct($rootPath) {
    $dotenv = Dotenv::createImmutable($rootPath);
    $dotenv->load();
    self::$__ROOT_DIR__ = $rootPath;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->db = Database::Instance()->connect();
    $this->model = new Model();
    self::$mail = new Mail();
    self::$app = $this;
  }
  public function run() {
    echo $this->router->resolve();
  }
}
