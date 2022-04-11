<?php
namespace router;

use app\controllers\ContactController;
use core\Application;
use app\controllers\HomeController;
use app\controllers\ProductController;
use app\models\Product;

$app = Application::Instance();
$app->router->prefix("/shop");
$app->router->get("/product", [ProductController::class,"shop"]);
$app->router->get("/hello", [ProductController::class,"getProducts"]);

