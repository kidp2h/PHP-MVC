<?php 

namespace database\migrations;
interface IMigration {
  public function up();
  public function down();
}