<?php
namespace router;

use core\Application;
use app\controllers\ProductController;
use app\middlewares\AdminMiddleware;
use app\middlewares\AuthMiddleware;

$app = Application::Instance();
$app->router->prefix("/product");
$app->router->get("/", [ProductController::class, "getListProductNotHaveStoreId"]);
$app->router->get("/on50", [ProductController::class, "getProductOn50"]);
$app->router->post("/addProductDetails", [[AuthMiddleware::class, "isAuth"], [AdminMiddleware::class, "isManagerStore"]], [ProductController::class, "addProductDetails"]);


