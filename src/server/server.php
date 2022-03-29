<?php
$uri = urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
if ($uri !== "/" && file_exists(dirname(__DIR__) . "/src/public" . $uri.".php")) return false;
require_once __DIR__ . "/../public/index.php";
