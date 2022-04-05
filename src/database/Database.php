<?php

namespace database;

class Database {
  private static Database $instance;
  protected static \mysqli $con;

  public static function Instance() {
    if (!isset(self::$instance)) self::$instance = new Database();
    return self::$instance;
  }

  static public function connect() {
    try {
      self::$con = mysqli_connect($_ENV['HOSTNAME_DB'], $_ENV["USERNAME_DB"], $_ENV["PASSWORD_DB"]);
      mysqli_set_charset(self::$con, 'UTF8');
      if (mysqli_connect_errno()) {
        echo "Failed" . mysqli_connect_error();
        exit();
      }
      return self::$con;
    } catch (\Exception $th) {
      throw $th;
      exit();
    }
  }
  public function getDatabase() : \mysqli {
    return self::$con;
  }
}
