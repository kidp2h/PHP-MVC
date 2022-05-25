<?php

namespace core;

use database\Database;
use ReflectionProperty;

class Model {
  public static $db;
  public function __construct() {
    self::$db = Database::Instance()->getDatabase();
  }
  private function tableName() {
    return strtolower(str_replace("app\models\\", "", static::class));
  }

  private function getTypeProp(string $key){
    $property = new ReflectionProperty(static::class, $key);
    $type = $property->getType()?->getName();
    return $type;
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
      $result = self::$db->query($sql);
      if($result) return (object)["status" => true, "id" => self::$db->insert_id]; 
    } catch (\Exception $e) {
      return (object)["message" => $e->getMessage(), "status" => false];
    }
  }
  public function findOne(array $fieldSelect, string $where) : static | null {
    try {
      $fieldSelect = implode(",", $fieldSelect);
      $table = $this->tableName();
      $sql = "SELECT {$fieldSelect} FROM {$table} WHERE $where";
      $result = self::$db->query($sql);
      $data = $result->fetch_assoc();
      if (!empty($data)) return call_user_func([static::class, "resolve"], $data);
      return $data;
    } catch (\Throwable $th) {
      var_dump($th);
    } 
  }
  public function find(array $fieldSelect, string $where){
    try {
      $fieldSelect = implode(",", $fieldSelect);
      $table = $this->tableName();
      $sql = "SELECT {$fieldSelect} FROM {$table} WHERE $where";
      $result = self::$db->query($sql);
      $data = [];
      while($row = $result->fetch_assoc()){
        $dataObject = call_user_func([static::class, "resolve"], $row);
        array_push($data, $dataObject);
      }
      return $data;
    } catch (\Throwable $th) {
      var_dump($th);
    } 
  }
  public function update(array $set, string $where) {
    $setQuery = "";
    foreach ($set as $key => $value) {
      if($this->getTypeProp($key) == "int") 
        $setQuery .= $key . "=" . $value . ", ";
      else 
        $setQuery .= $key . "='" . $value . "', ";
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
