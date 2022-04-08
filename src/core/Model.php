<?php

namespace core;

use database\Database;
use mysqli;
use app\models\User;

class Model {
  public static $db;

  public function __construct() {
    self::$db = Database::Instance()->getDatabase();
  }
  public function tableName() {
    return strtolower(str_replace("app\models\\", "", static::class));
  }
  public function create(array $data) {
    $fields = "";
    $values = "";
    foreach ($data as $key => $value) {
      $fields .= $key . ", ";
      $values .= '"' . $value . '"' . ", ";
    }
    $fields = rtrim($fields, ", ");
    $values = rtrim($values, ", ");
    $table = $this->tableName();
    $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
    try {
      return self::$db->query($sql);
    } catch (\Exception $e) {
      return (object)["message" => $e->getMessage(), "status" => false];
    }
  }
  public function read(array $fieldSelect, string $where) {
    $fieldSelect = implode(",", $fieldSelect);
    $table = $this->tableName();
    $sql = "SELECT {$fieldSelect} FROM {$table} WHERE {$where}";
    $data = mysqli_fetch_assoc(self::$db->query($sql));
    if (!empty($data)) return call_user_func([static::class, "resolve"], $data);
    return $data;
  }
  public function update(array $set, string $where) {
    $setQuery = "";
    foreach ($set as $key => $value) {
      $setQuery .= $key . "=" . $value . ", ";
    }
    $setQuery = rtrim($setQuery, ", ");
    $table = $this->tableName();
    $sql = "UPDATE {$table} SET {$setQuery} WHERE {$where}";

    try {
      return self::$db->query($sql);
    } catch (\Exception $e) {
      return (object)["message" => $e->getMessage(), "status" => false];
    }
  }
  public function delete(string $where) {
    $table = $this->tableName();
    $sql = "DELETE FROM {$table} WHERE {$where}";
    try {
      return self::$db->query($sql);
    } catch (\Exception $e) {
      return (object)["message" => $e->getMessage(), "status" => false];
    }
  }
}
