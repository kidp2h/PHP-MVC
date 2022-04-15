<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);

$dotenv->load();
use database\migrations\m001_initialize as mInitialize;
class Migrations
{
  public function __construct()
  {
    new mInitialize();
  }
}

new Migrations();
