<?php

namespace database\migrations;
use database\Database;

class m001_initialize implements IMigration {
  public static \mysqli $con;
  public function __construct() {
    self::$con = mysqli_connect($_ENV["HOSTNAME_DB"], $_ENV["USERNAME_DB"], $_ENV["PASSWORD_DB"]);
    $this->up();
  }
  public function up(){
    self::$con->multi_query("CREATE DATABASE IF NOT EXISTS `shop`;
                            CREATE TABLE IF NOT EXISTS `shop`.`user`(
                            `id` INT(255) NOT NULL AUTO_INCREMENT,
                            `username` VARCHAR(15) COLLATE utf8mb4_vietnamese_ci NOT NULL,
                            `password` TEXT NOT NULL,
                            `email` VARCHAR(50) NOT NULL,
                            `fullName` VARCHAR(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
                            `phoneNumber` VARCHAR(15) NULL,
                            `address` VARCHAR(50) COLLATE utf8mb4_vietnamese_ci NULL,
                            `isVerified` BOOLEAN NOT NULL DEFAULT TRUE,
                            `tokenVerify` INT NULL,
                            `createdAt` INT NOT NULL,
                            `updatedAt` INT NOT NULL,
                            PRIMARY KEY(`id`),
                            UNIQUE `UNIQUE_USERNAME`(`username`),
                            UNIQUE `UNIQUE_PHONE`(`phoneNumber`),
                            UNIQUE `UNIQUE_TOKEN`(`tokenVerify`),
                            UNIQUE `UNIQUE_EMAIL`(`email`)
                            ) ENGINE = InnoDB;");
  }
  public function down(){
    self::$con->query("DROP TABLE IF EXISTS `shop`.`user`");
  }
}
