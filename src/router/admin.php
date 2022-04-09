<?php
namespace router;
use core\Application;
use app\controllers\HomeController;
$app = Application::Instance();
$app->router->prefix("/admin");
$app->router->get("/product", [ProductController::class, "home"]);

