<?php

namespace server;

use core\Application;

try {
  require_once __DIR__ . '/../vendor/autoload.php';
  define("DIRSRC", dirname(__DIR__));
  Application::Instance();

  $uri = urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
  if ($uri !== "/" && file_exists(dirname(__DIR__) . "/src/public" . $uri . ".php")) return false;
  require_once __DIR__ . "/../public/index.php";
} catch (\Throwable $th) {
  echo $th;
}
