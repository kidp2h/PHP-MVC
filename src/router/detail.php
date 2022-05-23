<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\DetailController;
use core\Application;
$app = Application::Instance();
$app->router->prefix("/detail");
$app->router->get("/product/{id:\d+}/{store:\d+}/", [DetailController::class, "handleDetail"]);