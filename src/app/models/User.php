<?php

namespace app\models;

use core\Model;
use DateTime;
use utils\Utils;

class User extends Model {
  const TABLE = "user";
  private self $user;
  public string $id;
  public string $username;
  public string $password;
  public string $email;
  public string $fullName;
  public ?string $phoneNumber;
  public ?string $address;
  public bool $isVerified;
  public ?string $tokenVerify;
  public string $refreshToken;
  public int $permission;
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
    return (object)["status" => Utils::verifyBcrypt($user->password, $password), "user" => $user];
  }

  public static function resolve(array $data) {
    $user = self::__self__();
    array_key_exists("id",$data) == true ? $user->id = $data["id"] : null;
    array_key_exists("username",$data) == true ? $user->username = $data["username"] : null;
    array_key_exists("password",$data) == true ? $user->password = $data["password"] : null;
    array_key_exists("email",$data) == true ? $user->email = $data["email"] : null;
    array_key_exists("fullName",$data) == true ? $user->fullName = $data["fullName"] : null;
    array_key_exists("phoneNumber",$data) == true ? $user->phoneNumber = $data["phoneNumber"] : null;
    array_key_exists("address",$data) == true ? $user->address = $data["address"] : null;
    array_key_exists("permission",$data) == true ? $user->permission = $data["permission"] : null;
    array_key_exists("isVerified",$data) == true ? $user->isVerified = $data["isVerified"] : null;
    array_key_exists("tokenVerify",$data) == true ? $user->tokenVerify = $data["tokenVerify"] : null;
    return $user;
  }

  public static function getTokenReset(string $email){
    $baseUrl = $_ENV["BASE_URL"];
    $secretKey = Utils::hashBcrypt($_ENV["SECRET_KEY"]);
    $now = new DateTime();
    $expire = ($now->add(new \DateInterval("PT300S")))->getTimestamp();
    $user = User::__self__()->read(["*"],"email='$email'");
    if(!isset($user)){
      return ["status" => false, "message" => "Invalid id"];
    }
    $info = json_encode([
      "id" => $user->id,
      "email" => $user->email
    ]);
    $data = "$baseUrl.$info.$expire";
    $hash = hash_hmac("sha256", $data,$_ENV["SECRET_KEY"]);
    return ["accessToken" => "{$hash}.&$$@{$expire}.&$$@{$user->tokenVerify}.&$$@{$secretKey}"];
  }

  public static function decodeTokenReset(string $tokenReset){
    $tokenReset = urldecode($tokenReset);
    $arrayHash = explode(".&$$@",$tokenReset);
    $secretKeyHash = $arrayHash[3];
    var_dump($arrayHash);
    $now = (new DateTime())->getTimestamp();
    if(count($arrayHash)  != 4 || !Utils::verifyBcrypt($secretKeyHash, $_ENV["SECRET_KEY"])) 
      return ["status" => false, "message" => "Invalid Token", "error-code" => -1];
    if(count($arrayHash) == 4) {
      $hash = $arrayHash[0];
      $expire = $arrayHash[1];
      $token = $arrayHash[2];
      $baseUrl = $_ENV['BASE_URL'];
      $user = User::__self__()->read(["*"],"tokenVerify='$token'");
      $info = json_encode([
        "id" => $user->id,
        "email" => $user->email
      ]);
      if($now > (int)$expire) return ["status" => false, "message" => "This token is expire", "error-code" => 0];

      $data = hash_hmac("sha256","$baseUrl.$info.$expire" ,$_ENV["SECRET_KEY"]);
      if($data == $hash) return ["status" => true, "user" => $user, "result" => json_decode($info)];
    }
    return ["status" => false, "message" => "Invalid Token", "error-code" => 999];
  }

  public static function applyRefreshToken(int $id){
    $baseUrl = $_ENV["BASE_URL"];
    $secretKey = Utils::hashBcrypt($_ENV["SECRET_KEY"]);
    $now = new DateTime();
    $expire = ($now->add(new \DateInterval("PT2678400S")))->getTimestamp();
    $data = "$baseUrl.$expire";
    $hash = hash_hmac("sha256", $data,$_ENV["SECRET_KEY"]);
    $refreshToken = "{$hash}.&$@{$expire}.&$@{$id}.&$@{$secretKey}";
    return User::__self__()->update(["refreshToken" => "'{$refreshToken}'"], "id=$id");
  }

  public static function verifyRefreshToken($refreshToken){
    $arrayHash = explode(".&$@", $refreshToken);
    if(count($arrayHash) == 0 || !Utils::verifyBcrypt($arrayHash[3],$_ENV["SECRET_KEY"]))
      return ["status" => false, "message" => "Invalid Refresh Token", "error-code" => -1];
    if(count($arrayHash) == 4){
      $hash = $arrayHash[0];
      $baseUrl = $_ENV["BASE_URL"];
      $expire = $arrayHash[1];
      $data = hash_hmac("sha256","$baseUrl.$expire", $_ENV["SECRET_KEY"]);  
      return $data == $hash;
    }
    return ["status" => false, "message" => "Invalid Refresh Token", "error-code" => -1];
  }
  public function updateUsername(int $id, $username) {
    try {
      return self::$db->query("UPDATE {self::TABLE} SET username='{$username}' WHERE id={$id}");
    } catch (\Exception $e) {
      return (object)["message" => "Username has already exist !!", "status" => false];
    }
  }

  public static function sendMailVerifyAccount(array $to) {
    $token = Utils::v4();
    $address = $to["address"];
    $server = $_SERVER['SERVER_NAME'];
    Utils::sendMailWithTemplate(
      ['address' => $to["address"]],
      "Verify Account",
      ["verifyToken" => $token, "baseUrl" => $_ENV["BASE_URL"]]
    );
    User::__self__()->update(["tokenVerify" => "'$token'"], "email='$address'");

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

  public static function newAccessToken(int $id) {
    $baseUrl = $_ENV["BASE_URL"];
    $secretKey = Utils::hashBcrypt($_ENV["SECRET_KEY"]);
    $now = new DateTime();
    $expire = ($now->add(new \DateInterval("PT300S")))->getTimestamp();
    $user = User::__self__()->read(["*"],"id=$id");
    if(!isset($user)){
      return ["status" => false, "message" => "Invalid id"];
    }
    $info = json_encode([
      "id" => $user->id,
      "username" => $user->username,
      "fullName" => $user->fullName,
      "permission" => $user->permission
    ]);
    $data = "$baseUrl.$info.$expire";
    $hash = hash_hmac("sha256", $data,$_ENV["SECRET_KEY"]);
    return ["accessToken" => "{$hash}.&$@{$expire}.&$@{$id}.&$@{$secretKey}"];
  }

  public static function decodeAccessToken($accessToken){
    $accessToken = urldecode($accessToken);
    $arrayHash = explode(".&$@",$accessToken);
    $secretKeyHash = $arrayHash[3];
    $now = (new DateTime())->getTimestamp();
    if(count($arrayHash)  != 4 || !Utils::verifyBcrypt($secretKeyHash, $_ENV["SECRET_KEY"])) 
      return ["status" => false, "message" => "Invalid Access Token", "error-code" => -1];
    if(count($arrayHash) == 4) {
      $hash = $arrayHash[0];
      $expire = $arrayHash[1];
      $id = $arrayHash[2];
      $baseUrl = $_ENV['BASE_URL'];
      $user = User::__self__()->read(["*"],"id=$id");
      $info = json_encode([
        "id" => $user->id,
        "username" => $user->username,
        "fullName" => $user->fullName,
        "permission" => $user->permission
      ]);
      if($now > (int)$expire) return ["status" => false, "id" => $id ,"message" => "This access token is expire", "error-code" => 0];

      $data = hash_hmac("sha256","$baseUrl.$info.$expire" ,$_ENV["SECRET_KEY"]);
      if($data == $hash) return ["status" => true, "id" => $id, "result" => json_decode($info)];
    }
    return ["status" => false, "message" => "Invalid Access Token", "error-code" => 999];
  }

  public function getUserByUsername($username){
    $sql = self::$db->query("SELECT * FROM user WHERE user.username = '$username'");
    while($row = mysqli_fetch_array($sql,1)) $data = $row;
    return $data;
  }
}
