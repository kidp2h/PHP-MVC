<?php
namespace router;

use app\controllers\AdminController;
use core\Application;
use app\controllers\HomeController;
$app = Application::Instance();
$app->router->prefix("/admin");
$app->router->get("/", [AdminController::class, "admin"]);
$app->router->get("/user", [AdminController::class, "user"]);
$app->router->get("/product", [AdminController::class, "product"]);
$app->router->get("/category", [AdminController::class, "category"]);
$app->router->get("/bill", [AdminController::class, "bill"]);
$app->router->get("/revenue", [AdminController::class, "revenue"]);

