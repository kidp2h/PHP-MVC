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
  public static function Mailer() {
    // self::$mail = new PHPMailer(true);
    // self::$mail->isSMTP();
    // self::$mail->Host       = 'smtp.sendgrid.net';
    // self::$mail->SMTPAuth   = true;
    // self::$mail->Username   = 'apikey';
    // self::$mail->Password   = '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';
    // self::$mail->SMTPSecure = "tls";
    // self::$mail->Port       = 25;
  }
  public function run() {
    echo $this->router->resolve();
  }
}
