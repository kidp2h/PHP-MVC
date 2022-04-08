<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\ContactController;
use app\controllers\HomeController;
use app\controllers\AuthController;
use app\controllers\UserController;
use app\controllers\AdminController;
use app\middlewares\UserMiddleware;
use core\Application;

$app = new Application(dirname(__DIR__));
$app->router->get("/", [HomeController::class, "home"]);
$app->router->post("/contact", [ContactController::class, "handleContact"]);
$app->router->get("/login", [AuthController::class, "login"]);
$app->router->get("/user",[UserController::class, "getUser"]);
$app->router->get("/register", [[UserMiddleware::class,"isAuth"]] ,[AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "handleRegister"]);
$app->router->get("/otp",[AuthController::class, "otp"]);
$app->router->post("/sendOTP/{phoneNumber:\d+}",[UserController::class, "sendOTP"]);
$app->router->get("/contact", [[UserMiddleware::class,"isAuth"],[UserMiddleware::class,"isAuth1"],[UserMiddleware::class,"isAuth2"]], [ContactController::class, "contact"]);
$app->router->get("/contact/{id:\d+}/{username:\w+}", [ContactController::class, "handleContact"]);
$app->router->post("/verifyEmail/{id:\d+}/{hash:.*}",[AuthController::class, "verifyEmail"]);
$app->router->get("/admin",[AdminController::class,"admin"]);
$app->run();
