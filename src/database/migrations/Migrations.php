<?php
namespace database\migrations;
use database\migrations\m001_initialize as mInitialize;
class Migrations {
  public function __construct() {
    new mInitialize();
  }
}
new Migrations();