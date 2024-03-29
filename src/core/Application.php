<?php

namespace core;

use app\models\User;
use app\models\Cart;
use app\models\Category;
use database\Database;
use Dotenv\Dotenv;
use SendGrid\Mail\Mail;
use core\QueryBuilder\Select;
use core\QueryBuilder\QueryBuilder;

class Application
{
  private static self $instance;
  public static string $__ROOT_DIR__;
  public static Application $app;
  public string $layout = "main";
  public Router $router;
  public ?Controller $controller = null;
  public Request $request;
  public Response $response;
  public Session $session;
  public View $view;
  public Model $model;
  public static ?User $user;
  public static $cart;
  public static $cartTotalPrice;
  public static $amountCartItem;
  public static array $data;
  public $db;

  public function __construct($rootPath)
  {
    error_reporting(0);
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
    if (!isset($_ENV["SECRET_KEY"])) {
      $dotenv = Dotenv::createImmutable(DIRSRC);
      $dotenv->load();
    }

    self::$__ROOT_DIR__ = $rootPath;
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request, $this->response);
    try {
      self::$user = null;
      self::$cart = null;
      error_reporting(0);
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Max-Age: 86400');    // cache for 1 day
      self::$__ROOT_DIR__ = $rootPath;
      $this->request = new Request();
      $this->response = new Response();
      $this->session = new Session();
      $this->router = new Router($this->request, $this->response);
      try {
        $this->db = Database::Instance()->connect();
      } catch (\Throwable $th) {
        var_dump($th);
        exit;
      }

      $this->model = new Model();
      $this->view = new View();
      $this->controller = new Controller();
      $this->session = new Session();
      self::$app = $this;

      if ($_COOKIE["accessToken"]) {
        $data = User::decodeAccessToken($_COOKIE["accessToken"]);
        if (isset($data["id"])) {
          $id = $data["id"];
          $this->session->set("id", $id);
          self::$user = $data["user"];
          self::$cart = Cart::__self__()->getProductFromCart($id);
          self::$cartTotalPrice = Cart::__self__()->totalPriceOfCart($id);
          self::$amountCartItem = Cart::__self__()->getAmountItem($id);
        }
      }
      $this->db = Database::Instance()->connect();
    } catch (\Throwable $th) {
      var_dump($th);
      exit;
    }

    $this->model = new Model();
    $this->view = new View();
    $this->controller = new Controller();
    $this->session = new Session();
    self::$app = $this;
    if (!isset($_SESSION["id"])) {
      if ($_COOKIE["accessToken"]) {
        $data = User::decodeAccessToken($_COOKIE["accessToken"]);
        if (isset($data["id"])) {
          $id = $data["id"];
          $this->session->set("id", $id);
        }
      }
    }
  }

  public static function Instance()
  {
    if (!isset(self::$instance)) self::$instance = new Application(dirname(__DIR__));
    return self::$instance;
  }
  public static function getCookie(string $key)
  {
    return $_COOKIE[$key];
  }
  public static function setCookie(string $key, string $value, string $expire, string $path = "/")
  {
    setcookie($key, $value, $expire, $path, "", true, true);
  }

  public static function removeCookie(string $key)
  {
    setcookie($key, '', -1);
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}
