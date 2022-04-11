<?php
namespace core;
use database\Database;
use Dotenv\Dotenv;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use SendGrid\Mail\Mail;
use Facebook\Facebook;

class Application {
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
  public static Mail $mail;
  public Facebook $facebook;
  public $db;

  public function __construct($rootPath) {
    error_reporting(0);
    $dotenv = Dotenv::createImmutable($rootPath);
    $dotenv->load();
    self::$__ROOT_DIR__ = $rootPath;
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request, $this->response);
    $this->db = Database::Instance()->connect();
    $this->model = new Model();
    $this->view = new View();
    $this->facebook = new Facebook([
      'app_id' => $_ENV["FB_APP_ID"],
      'app_secret' => $_ENV["FB_APP_SECRET"],
      'default_graph_version' => 'v2.10',
    ]);
    $helper = $this->facebook->getRedirectLoginHelper();
    try {
      if(isset($_SESSION["facebook_access_token"])){
        $accessToken = $_SESSION["facebook_access_token"];
      }else{
        $accessToken = $helper->getAccessToken();
      }
    }catch(FacebookResponseException $e){
      echo $e->getMessage();
      exit;
    }catch (FacebookSDKException $e){
      echo $e->getMessage();
      exit;
    }
    $loginURL = $helper->getLoginUrl("http://localhost/facebook/callback");
    $this->controller = new Controller();
    self::$mail = new Mail();
    self::$app = $this;
  }

  public static function Instance(){
    if(!isset(self::$instance)) self::$instance = new Application(dirname(__DIR__));
    return self::$instance;
  }

  public static function setCookie(string $key, string $value, string $expire, string $path = "/"){
    setcookie($key, $value,$expire, $path);
  }

  public function run() {
    echo $this->router->resolve();
  }
}
