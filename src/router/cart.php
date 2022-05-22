<?php
namespace router;

use app\controllers\CartController;
use app\middlewares\AuthMiddleware;
use core\Application;

$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/cart", [[AuthMiddleware::class, "isAuth"]], [CartController::class, "handleRenderCart"]);
$app->router->get("/cart/modal", [[AuthMiddleware::class, "isAuth"]], [CartController::class, "handleRenderCartModal"]);
$app->router->post("/cart", [CartController::class, "handleAddToCart"]);
$app->router->post("/cart/edit", [[AuthMiddleware::class, "isAuth"]], [CartController::class, "handleUpdateToCart"]);
$app->router->post("/cart/delete", [[AuthMiddleware::class, "isAuth"]], [CartController::class, "handleDeleteToCart"]);