<?php

declare(strict_types=1);

use core\Application;


require_once __DIR__ . '/../vendor/autoload.php';
$app = new Application(dirname(__DIR__));
require(__DIR__ . '/../app/graphql/boot.php');
