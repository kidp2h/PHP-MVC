<?php

namespace database\migrations;

class m001_initialize implements IMigration {
  public static \mysqli $con;
  
  public function __construct() {
    try {
      self::$con = mysqli_connect($_ENV['HOSTNAME_DB'], $_ENV["USERNAME_DB"], $_ENV["PASSWORD_DB"]);
      mysqli_set_charset(self::$con, 'UTF8');

      if (mysqli_connect_errno()) {
        echo "Failed" . mysqli_connect_error();
        exit();
      }
      $this->up();
    } catch (\Exception $th) {
      throw $th;
      exit();
    }
    
  }

  public function up(){
    $sql = file_get_contents('./database/shop.sql', true);
    echo $sql;
    //self::$con->multi_query($sql);
  }
  public function down(){
    self::$con->query("DROP TABLE IF EXISTS `shop`.`user`");
  }
}
