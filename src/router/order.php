<?php
namespace router;

use app\controllers\OrderController;
use app\middlewares\AuthMiddleware;
use core\Application;

$app = Application::Instance();
$app->router->prefix("");
$app->router->get("/order", [[AuthMiddleware::class, "isAuth"]], [OrderController::class, "handleRenderOrder"]);
$app->router->post("/order", [[AuthMiddleware::class, "isAuth"]], [OrderController::class, "handleAddOrder"]);
$app->router->post("/orderByStatus", [[AuthMiddleware::class, "isAuth"]], [OrderController::class, "handleStatusClick"]);
$app->router->post("/orderUpdateStatus", [[AuthMiddleware::class, "isAuth"]], [OrderController::class, "handleUpdateStatus"]);