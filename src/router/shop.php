<?php
namespace router;

use app\controllers\ContactController;
use core\Application;
use app\controllers\HomeController;
$app = Application::Instance();
$app->router->prefix("/shop");
$app->router->get("/product", [ContactController::class, "shop"]);

