<?php
namespace router;

use app\controllers\ContactController;
use core\Application;
use app\controllers\HomeController;
use app\controllers\ShopController;

$app = Application::Instance();
$app->router->prefix("/shop");
<<<<<<< HEAD
$app->router->get("/product", [ProductController::class,"shop"]);
$app->router->get("/hello", [ProductController::class,"getProducts"]);
=======
$app->router->get("/", [ShopController::class, "shop"]);
>>>>>>> main

