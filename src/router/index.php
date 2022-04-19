<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\middlewares\AuthMiddleware;
use core\Application;

$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/",[[AuthMiddleware::class,"isAuth"]] ,[HomeController::class, "home"]);
$app->router->get("/signin",[[AuthMiddleware::class,"isLogout"]] , [AuthController::class, "signin"]);
$app->router->post("/signin", [AuthController::class, "handleSignIn"]);

$app->router->get("/signup", [AuthController::class, "signup"]);
$app->router->post("/signup",[AuthController::class, "handleSignUp"]);
$app->router->post("/oauth",[AuthController::class, "handleOAuth"]);


$app->router->get("/logout",[AuthController::class, "logout"]);
$app->router->post("/accessToken", [AuthController::class, "getAccessToken"]);
$app->router->post("/verifyAccessToken", [AuthController::class, "verifyAccessToken"]);
$app->router->post("/verifyRefreshToken", [AuthController::class, "verifyRefreshToken"]);

