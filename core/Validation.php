<?php
namespace core;
abstract class Validation {
  private static Validation $instance;
  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MIN = 'min';
  public const RULE_MAX = 'max';
  public const RULE_MATCH = 'match';

  public static function Instance(){
    if(!isset($instance)){
      self::$instance = new Validation();
    }
    return self::$instance;
  }

  // public function loadData($data){
  //   foreach ($data as $key => $value) {
  //     if()
  //   }
  // }
  public function validate($data){
    
  }

}
?>