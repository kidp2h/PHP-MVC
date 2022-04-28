<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
use database\migrations\m001_initialize as mInitialize;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Migrations {
  public function __construct() {
    new mInitialize();
  }
}
new Migrations();
