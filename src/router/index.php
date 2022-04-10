<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\TestController;

use core\Application;
$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/", [HomeController::class, "home"]);
$app->router->get("/captcha", [TestController::class, "test"]);
// $app->router->post("/contact", [ContactController::class, "handleContact"]);
// $app->router->get("/login", [AuthController::class, "login"]);
// $app->router->get("/user",[UserController::class, "getUser"]);
$app->router->get("/register", [AuthController::class, "register"]);
// $app->router->post("/register", [AuthController::class, "handleRegister"]);
// $app->router->get("/otp",[AuthController::class, "otp"]);
// $app->router->post("/sendOTP/{phoneNumber:\d+}",[UserController::class, "sendOTP"]);
// $app->router->get("/contact", [[UserMiddleware::class,"isAuth"],[UserMiddleware::class,"isAuth1"],[UserMiddleware::class,"isAuth2"]], [ContactController::class, "contact"]);
// $app->router->get("/contact/{id:\d+}/{username:\w+}", [ContactController::class, "handleContact"]);
//$app->router->post("/verifyEmail/{id:\d+}/{hash:.*}",[AuthController::class, "verifyEmail"]);
// $app->router->get("/admin",[AdminController::class,"admin"]);
// $app->router->get("/shop",[ProductController::class,"shop"]);
// $app->router->get("/detail",[DetailController::class,"detail"]);
// $app->router->get("/test",[TestController::class,"test"]);
//$app->router->post("/contact/{id:\d+}/{username:\w+}", [ContactController::class, "contact"]);