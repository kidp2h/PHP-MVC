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
  public ?string $phoneNumber = NULL;
  public ?string $address = NULL;
  public bool $isVerified = false;
  public ?string $tokenVerify = NULL;
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
  public static function resolve(array $data) {
    $user = new User();
    $user->username = $data["username"];
    $user->password = $data["password"];
    $user->email = $data["email"];
    $user->fullName = $data["fullName"];
    $user->phoneNumber = $data["phoneNumber"];
    $user->address = $data["address"];
    $user->isVerified = $data["isVerified"];
    $user->tokenVerify = $data["tokenVerify"];
    return $user;
  }

  public function updateUsername(int $id, $username) {
    try {
      return self::$db->query("UPDATE {self::TABLE} SET username='{$username}' WHERE id={$id}");
    } catch (\Exception $e) {
      return (object)["message" => "Username has already exist !!", "status" => false];
    }
  }

  public static function sendMailVerifyAccount(array $to, $token) {
    Utils::sendMail(
      ['address' => $to["address"], 'name' => $to["name"]],
      "Verify Account",
      "Please verify this account with this code: {$token}"
    );
  }
  public static function generateToken() {
    $token = "";
    for ($i = 1; $i < 15; $i++) {
      if (mt_rand(0, 1)) {
        $token .= chr(mt_rand(65, 90))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(65, 90))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(65, 90))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(65, 90));
      } else {
        $token .= chr(mt_rand(97, 122))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(65, 90))
          . chr(mt_rand(97, 122))
          . chr(mt_rand(65, 90))
          . chr(mt_rand(65, 90))
          . chr(mt_rand(97, 122));
      }
    }
    return $token;
  }
}
