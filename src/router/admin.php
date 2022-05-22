<?php
namespace router;

use app\controllers\AdminController;
use app\middlewares\AuthMiddleware;
use core\Application;

$app = Application::Instance();
$app->router->prefix("/admin");
$app->router->get("/",[[AuthMiddleware::class,"isAuth"],[AuthMiddleware::class, "isAdmin"],] ,[AdminController::class, "admin"]);
$app->router->get("/user", [AdminController::class, "user"]);
$app->router->get("/product", [AdminController::class, "product"]);
$app->router->get("/category", [AdminController::class, "category"]);
$app->router->get("/bill", [AdminController::class, "bill"]);
$app->router->get("/revenue", [AdminController::class, "revenue"]);

