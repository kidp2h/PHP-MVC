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

$app->router->get("/register", [[AuthMiddleware::class,"isLogout"]],[AuthController::class, "register"]);
$app->router->post("/register", [[AuthMiddleware::class,"isLogout"]],[AuthController::class, "handleRegister"]);

$app->router->get("/login", [[AuthMiddleware::class,"isLogout"]], [AuthController::class, "login"]);
$app->router->post("/login",[AuthController::class, "handleLogin"]);