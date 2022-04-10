<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\TestController;

use core\Application;
$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/", [HomeController::class, "home"]);

$app->router->get("/register", [AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "handleRegister"]);

$app->router->get("/login", [AuthController::class, "login"]);
$app->router->post("/login", [AuthController::class, "handleLogin"]);