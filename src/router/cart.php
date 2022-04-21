<?php
namespace router;

use app\controllers\CartController;
use core\Application;

$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/cart", [CartController::class, "handleRenderCart"]);
$app->router->get("/cart/modal", [CartController::class, "handleRenderCartModal"]);
$app->router->post("/cart", [CartController::class, "handleAddToCart"]);
$app->router->post("/cart/edit", [CartController::class, "handleUpdateToCart"]);
$app->router->post("/cart/delete", [CartController::class, "handleDeleteToCart"]);