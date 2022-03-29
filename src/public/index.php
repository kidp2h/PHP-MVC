<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\ContactController;
use app\controllers\HomeController;
use app\controllers\AuthController;
use core\Application;
use app\models\User;
use SendGrid\Mail\Mail;

$app = new Application(dirname(__DIR__));
// User::verifyAccount(5, User::generateToken());

// exit();
$app->router->get("/", [HomeController::class, "home"]);
$app->router->get("/contact", [ContactController::class, "contact"]);
$app->router->post("/contact", [ContactController::class, "handleContact"]);
$app->router->get("/login", [AuthController::class, "login"]);
$app->router->get("/register", [AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "handleRegister"]);
$app->router->get("/admin", "admin2");
$app->run();
