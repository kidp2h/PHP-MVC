<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\TestController;
use app\middlewares\AuthMiddleware;
use core\Application;
$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/",[[AuthMiddleware::class,"isAuth"]], [HomeController::class, "home"]);



$app->router->get("/signin", [AuthController::class, "signin"]);
$app->router->post("/signin",[AuthController::class, "handleSignIn"]);

$app->router->get("/signup", [AuthController::class, "signup"]);
$app->router->post("/signup",[AuthController::class, "handleSignUp"]);