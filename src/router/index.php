<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\middlewares\AuthMiddleware;
use core\Application;

$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/",[[AuthMiddleware::class, "isTokenExpire"]] ,[HomeController::class, "home"]);
$app->router->get("/signin", [[AuthMiddleware::class, "isLogout"]], [AuthController::class, "signin"]);
$app->router->post("/signin", [AuthController::class, "handleSignIn"]);

$app->router->get("/signup", [AuthController::class, "signup"]);
$app->router->post("/signup", [AuthController::class, "handleSignUp"]);
$app->router->post("/oauth", [AuthController::class, "handleOAuth"]);
$app->router->get("/logout", [AuthController::class, "logout"]);
$app->router->get("/resetPassword/{tokenReset:.*}", [[AuthMiddleware::class, "isLogout"],[AuthMiddleware::class, "isTokenReset"]], [AuthController::class, "resetPassword"]);
$app->router->post("/resetPassword", [[AuthMiddleware::class, "isLogout"], [AuthMiddleware::class, "isTokenReset"]], [AuthController::class, "handleResetPassword"]);
$app->router->get("/forgotPassword", [[AuthMiddleware::class, "isLogout"]], [AuthController::class, "forgotPassword"]);
$app->router->post("/forgotPassword", [[AuthMiddleware::class, "isLogout"]], [AuthController::class, "handleForgotPassword"]);
$app->router->get("/verify/{token:.*}",[[AuthMiddleware::class, "isLogout"]], [AuthController::class, "handleVerifyAccount"]);
$app->router->post("/getTokenReset", [AuthController::class, "getTokenReset"]);
$app->router->post("/verifyTokenReset", [AuthController::class, "verifyTokenReset"]);
$app->router->post("/sendOTP", [AuthController::class, "sendOTP"]);
$app->router->post("/verifyOTP", [AuthController::class, "verifyOTP"]);
$app->router->get("/NotFound", [HomeController::class, "PageNotFound"]);
//$app->router->post("/accessToken", [AuthController::class, "getAccessToken"]);
$app->router->post("/verifyAccessToken", [AuthController::class, "verifyAccessToken"]);
//$app->router->post("/verifyRefreshToken", [AuthController::class, "verifyRefreshToken"]);