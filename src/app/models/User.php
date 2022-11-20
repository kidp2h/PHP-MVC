<?php

namespace app\models;

use core\Model;
use DateTime;
use utils\Utils;
use core\Application;

class User extends Model
{
  // public self $user;
  public int $id;
  public string $username;
  public string $password;
  public string $email;
  public string $fullName;
  public ?string $phoneNumber;
  public bool $isActivePhone;
  public ?string $address;
  public bool $isVerified;
  public ?string $tokenVerify;
  public ?string $refreshToken;
  public int $permission;
  public string $type;
  public string $createdAt;
  public string $updatedAt;

  public function __construct()
  {
  }

  public static function __self__(): static
  {
    return new static();
  }

  // public function fillInstance($username, $password, $email, $fullName, $phoneNumber = NULL, $address = NULL, $tokenVerify = NULL, $refreshToken, $permission = -1, $type = "local")
  // {

  //   $this->user->username = $username;
  //   $this->user->password = $password;
  //   $this->user->email = $email;
  //   $this->user->fullName = $fullName;
  //   $this->user->phoneNumber = $phoneNumber;
  //   $this->user->address = $address;
  //   $this->user->tokenVerify = $tokenVerify;
  //   $this->user->refreshToken = $refreshToken;
  //   $this->user->permission = $permission;
  //   $this->user->type = $type;
  //   return $this->user;
  // }

  public function setUsername(string $username)
  {
    $this->user->username = $username;
  }
  public function setPassword(string $password)
  {
    $this->password = $password;
  }
  public function setEmail(string $email)
  {
    $this->user->email = $email;
  }
  public function setPhoneNumber(string $phoneNumber)
  {
    $this->user->phoneNumber = $phoneNumber;
  }
  public function setAddress(string $address)
  {
    $this->user->address = $address;
  }
  public function setFullName(string $fullName)
  {
    $this->user->fullName = $fullName;
  }
  public function setTokenVerify(string $tokenVerify)
  {
    $this->user->tokenVerify = $tokenVerify;
  }
  public function getUser()
  {
    return $this->user;
  }
  public function checkUser(string $username, string $password)
  {
    $user = $this->findOne(["*"], "username='$username'");
    // if(!$user) return false;
    return (object)["status" => Utils::verifyBcrypt($user->password, $password), "user" => $user];
  }

  public static function resolve(array $data)
  {
    $user = self::__self__();
    if (count($data) != 0) {
      array_key_exists("id", $data) == true ? $user->id = $data["id"] : null;
      array_key_exists("username", $data) == true ? $user->username = $data["username"] : null;
      array_key_exists("password", $data) == true ? $user->password = $data["password"] : null;
      array_key_exists("email", $data) == true ? $user->email = $data["email"] : null;
      array_key_exists("fullName", $data) == true ? $user->fullName = $data["fullName"] : null;
      array_key_exists("phoneNumber", $data) == true ? $user->phoneNumber = $data["phoneNumber"] : null;
      array_key_exists("isActivePhone", $data) == true ? $user->isActivePhone = $data["isActivePhone"] : null;
      array_key_exists("address", $data) == true ? $user->address = $data["address"] : null;
      array_key_exists("permission", $data) == true ? $user->permission = $data["permission"] : null;
      array_key_exists("type", $data) == true ? $user->type = $data["type"] : null;
      array_key_exists("isVerified", $data) == true ? $user->isVerified = $data["isVerified"] : null;
      array_key_exists("tokenVerify", $data) == true ? $user->tokenVerify = $data["tokenVerify"] : null;
      array_key_exists("refreshToken", $data) == true ? $user->refreshToken = $data["refreshToken"] : null;
      return $user;
    } else {
      return null;
    }
  }

  public static function decodeTokenReset(string $tokenReset)
  {
    $tokenReset = urldecode($tokenReset);
    $arrayHash = explode(".&$$@", $tokenReset);
    $secretKeyHash = $arrayHash[3];
    $now = (new DateTime())->getTimestamp();
    if (count($arrayHash)  != 4 || !Utils::verifyBcrypt($secretKeyHash, $_ENV["SECRET_KEY"]))
      return ["status" => false, "message" => "Invalid Token", "error-code" => -1];
    if (count($arrayHash) == 4) {
      $hash = $arrayHash[0];
      $expire = $arrayHash[1];
      $token = $arrayHash[2];
      $baseUrl = $_ENV['BASE_URL'];
      $user = User::__self__()->findOne(["*"], "tokenVerify='$token'");
      $info = json_encode([
        "id" => $user->id,
        "email" => $user->email
      ]);
      if ($now > (int)$expire) return ["status" => false, "message" => "This token is expire", "isExpire" => true];

      $data = hash_hmac("sha256", "$baseUrl.$info.$expire", $_ENV["SECRET_KEY"]);
      if ($data == $hash) return ["status" => true, "user" => $user];
    }
    return ["status" => false, "message" => "Invalid Token", "error-code" => 999];
  }

  public static function applyRefreshToken(int $id)
  {
    $baseUrl = $_ENV["BASE_URL"];
    $secretKey = Utils::hashBcrypt($_ENV["SECRET_KEY"]);
    $now = new DateTime();
    $expire = ($now->add(new \DateInterval("PT267899999400S")))->getTimestamp();
    $data = "$baseUrl.$expire";
    $hash = hash_hmac("sha256", $data, $_ENV["SECRET_KEY"]);
    $refreshToken = "{$hash}.&$@{$expire}.&$@{$id}.&$@{$secretKey}";
    $result = User::__self__()->update(["refreshToken" => "$refreshToken"], "id=$id");
    return $result;
  }

  public static function verifyRefreshToken($refreshToken)
  {
    $arrayHash = explode(".&$@", $refreshToken);
    if (count($arrayHash) == 0 || !Utils::verifyBcrypt($arrayHash[3], $_ENV["SECRET_KEY"]))
      return ["status" => false, "message" => "Invalid Refresh Token", "error-code" => -1];
    if (count($arrayHash) == 4) {
      $hash = $arrayHash[0];
      $baseUrl = $_ENV["BASE_URL"];
      $expire = $arrayHash[1];
      $data = hash_hmac("sha256", "$baseUrl.$expire", $_ENV["SECRET_KEY"]);
      return $data == $hash;
    }
    return ["status" => false, "message" => "Invalid Refresh Token", "error-code" => -1];
  }
  public function updateUsername(int $id, $username)
  {
    try {
      return self::$db->query("UPDATE {self::TABLE} SET username='{$username}' WHERE id={$id}");
    } catch (\Exception $e) {
      return (object)["message" => "Username has already exist !!", "status" => false];
    }
  }


  public static function newAccessToken(int $id)
  {
    $baseUrl = $_ENV["BASE_URL"];
    $secretKey = Utils::hashBcrypt($_ENV["SECRET_KEY"]);
    $now = new DateTime();
    $expire = ($now->add(new \DateInterval("PT3600S")))->getTimestamp();
    $user = User::__self__()->findOne(["*"], "id=$id");
    if (!isset($user)) {
      return ["status" => false, "message" => "Invalid id"];
    }
    $info = json_encode([
      "id" => $user->id,
      "username" => $user->username,
      "fullName" => $user->fullName,
      "permission" => $user->permission
    ]);
    $data = "$baseUrl.$info.$expire";
    $hash = hash_hmac("sha256", $data, $_ENV["SECRET_KEY"]);
    return ["accessToken" => "{$hash}.&$@{$expire}.&$@{$id}.&$@{$secretKey}", "user" => $user];
  }

  public static function decodeAccessToken($accessToken)
  {
    $accessToken = urldecode($accessToken);
    $arrayHash = explode(".&$@", $accessToken);
    $secretKeyHash = $arrayHash[3];
    $now = (new DateTime())->getTimestamp();
    if (count($arrayHash)  != 4 || !Utils::verifyBcrypt($secretKeyHash, $_ENV["SECRET_KEY"]))
      return ["status" => false, "message" => "Invalid Access Token", "error-code" => -1];
    if (count($arrayHash) == 4) {
      $hash = $arrayHash[0];
      $expire = $arrayHash[1];
      $id = $arrayHash[2];
      $baseUrl = $_ENV['BASE_URL'];
      $user = User::__self__()->findOne(["*"], "id=$id");
      $info = json_encode([
        "id" => $user->id,
        "username" => $user->username,
        "fullName" => $user->fullName,
        "permission" => $user->permission
      ]);
      if ($now > (int)$expire) return ["status" => false, "id" => $id, "message" => "This access token is expire", "error-code" => 0];

      $data = hash_hmac("sha256", "$baseUrl.$info.$expire", $_ENV["SECRET_KEY"]);
      if ($data == $hash) return ["status" => true, "id" => $id, "user" => $user];
    }
    return ["status" => false, "message" => "Invalid Access Token", "error-code" => 999];
  }

  public function getUserByUsername($username)
  {
    $sql = self::$db->query("SELECT * FROM user WHERE user.username = '$username'");
    while ($row = mysqli_fetch_array($sql, 1)) $data = $row;
    if ($data) return self::resolve($data);
    return null;
  }
}
