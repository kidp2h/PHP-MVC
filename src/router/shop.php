<?php
namespace router;
use app\controllers\ContactController;
use core\Application;
use app\controllers\HomeController;
use app\controllers\ShopController;

$app = Application::Instance();
$app->router->prefix("/shop");
$app->router->get("/", [ShopController::class, "shop"]);


