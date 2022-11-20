<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../router/shop.php';
require_once __DIR__ . '/../router/detail.php';
require_once __DIR__ . '/../router/cart.php';
require_once __DIR__ . '/../router/order.php';
require_once __DIR__ . '/../router/product.php';
require_once __DIR__ . '/../router/index.php';
require_once __DIR__ . '/../router/admin.php';

use core\Application;

$app = Application::Instance();
$app->run();
