<?php

namespace app\models;

use core\Model;
use utils\Utils;

class User extends Model {
  const TABLE = "user";
  private self $user;
  public string $username;
  public string $password;
  public string $email;
  public string $fullName;
  public ?string $phoneNumber;
  public ?string $address;
  public bool $isVerified;
  public ?string $tokenVerify;
  public string $createdAt;
  public string $updatedAt;

  public function __construct() {
  }

  public static function __self__() {
    return new static();
  }

  public function fillInstance($username, $password, $email, $fullName, $phoneNumber = NULL, $address = NULL, $isVerified = false, $tokenVerify = NULL) {
    $this->user->username = $username;
    $this->user->password = $password;
    $this->user->email = $email;
    $this->user->fullName = $fullName;
    $this->user->phoneNumber = $phoneNumber;
    $this->user->address = $address;
    $this->user->isVerified = $isVerified;
    $this->user->tokenVerify = $tokenVerify;
  }

  public function setUsername(string $username) {
    $this->user->username = $username;
  }
  public function setPassword(string $password) {
    $this->user->password = $password;
  }
  public function setEmail(string $email) {
    $this->user->email = $email;
  }
  public function setPhoneNumber(string $phoneNumber) {
    $this->user->phoneNumber = $phoneNumber;
  }
  public function setAddress(string $address) {
    $this->user->address = $address;
  }
  public function setFullName(string $fullName) {
    $this->user->fullName = $fullName;
  }
  public function setIsVerified(bool $isVerified) {
    $this->user->isVerified = $isVerified;
  }
  public function setTokenVerify(string $tokenVerify) {
    $this->user->tokenVerify = $tokenVerify;
  }
  public function getUser() {
    return $this->user;
  }
  public function checkUser(string $username, string $password){
    $user = $this->read(["*"],"username='$username'");
    return Utils::verifyBcrypt($user->password, $password);
  }

  public static function resolve(array $data) {
    $user = self::__self__();
    array_key_exists("username",$data) == true ? $user->username = $data["username"] : null;
    array_key_exists("password",$data) == true ? $user->password = $data["password"] : null;
    array_key_exists("email",$data) == true ? $user->email = $data["email"] : null;
    array_key_exists("fullName",$data) == true ? $user->fullName = $data["fullName"] : null;
    array_key_exists("phoneNumber",$data) == true ? $user->phoneNumber = $data["phoneNumber"] : null;
    array_key_exists("address",$data) == true ? $user->address = $data["address"] : null;
    array_key_exists("isVerified",$data) == true ? $user->isVerified = $data["isVerified"] : null;
    array_key_exists("tokenVerify",$data) == true ? $user->tokenVerify = $data["tokenVerify"] : null;
    return $user;
  }

  public function updateUsername(int $id, $username) {
    try {
      //return self::$db->query("UPDATE {self::TABLE} SET username='{$username}' WHERE id={$id}");
    } catch (\Exception $e) {
      return (object)["message" => "Username has already exist !!", "status" => false];
    }
  }

  public static function sendMailVerifyAccount(array $to) {
    $result = Utils::generateOTP($to['address']);
    $address = $to["address"];
    $otp = $result[0];
    Utils::sendMail(
      ['address' => $to["address"]],
      "Verify Account",
      "Please verify this account with this code: {$otp}"
    );
    User::__self__()->update(["isVerified" => 1,"tokenVerify" => $otp], "email={$address}");

  }
  public static function sendCodeOTP($phone){
    //... send otp to phone user
    $result = Utils::generateOTP($phone);
    $otp = $result[0];
    $hash = $result[1];
    echo "{$otp}\n{$hash}\n";
    Utils::verifyOTP($phone, $hash, $otp);
    exit;
    return $phone;
  }
}
