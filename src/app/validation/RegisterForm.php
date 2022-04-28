<?php
namespace app\validation;
class RegisterForm extends Validation {

  private static RegisterForm $instance;
  public string $email = '';
  public string $password = '';
  public string $confirmPassword = '';

  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new RegisterForm();
    }
    return self::$instance;
  }

  public function rules(){
    return [
      'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
      "password" => [[self::RULE_MIN,'min' => 8], self::RULE_REQUIRED],
      "confirmPassword" => [[self::RULE_MATCH, 'match' => "password"], self::RULE_REQUIRED]
    ];
  }
}
?>