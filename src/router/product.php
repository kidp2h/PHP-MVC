<?php
namespace router;

use core\Application;
use app\controllers\ProductController;

$app = Application::Instance();
$app->router->prefix("/product");
$app->router->get("/on50", [ProductController::class, "getProductOn50"]);


