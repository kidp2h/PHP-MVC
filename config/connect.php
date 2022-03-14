<?php
  namespace config;
  $dotenv = \Dotenv\Dotenv::createImmutable('../');
  $dotenv->load();
  class Database {
    private static Database $instance;
    private static \mysqli $con;
    
    public static function Instance(){
      if(!isset(self::$instance))
        self::$instance = new Database();
      return self::$instance;
    }
    static public function connect(){
      try {
        self::$con = mysqli_connect($_ENV["HOSTNAME"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["DATABASE"]);
        if(mysqli_connect_errno()){
          echo "Failed" . mysqli_connect_error();
          exit();
        }
        return self::$con;
      } catch (\Exception $th) {
        throw $th;
        exit();
      }
    }
  }
?>