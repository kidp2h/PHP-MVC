<?php

namespace app\models;

use core\Model;
use DateInterval;
use DateTime;
use utils\Utils;

class RequestPending extends Model {
  private self $request;
  public string $id;
  public string $email;
  public string $token;
  public string $expire;
  

  public function __construct() {
  }

  public static function __self__() {
    return new static();
  }

  public function fillInstance($email, $token, $expire) {
    $this->request->email = $email;
    $this->request->token = $token;
    $this->request->expire = $expire;

  }

  public static function resolve(array $data) {
    $request = new RequestPending();
    array_key_exists("id",$data) == true ? $request->id = $data["id"] : null;
    array_key_exists("email",$data) == true ? $request->email = $data["email"] : null;
    array_key_exists("token",$data) == true ? $request->token = $data["token"] : null;
    array_key_exists("expire",$data) == true ? $request->expire = $data["expire"] : null;
    return $request;
  }

  public static function createRequest($email, $token){
    $now = new DateTime();
    $expire = ($now->add(new DateInterval('PT300S')))->format('Y-m-d H:i:s');
    var_dump($expire);
    $data = [
      "email" => $email,
      "token" => $token,
      "expire" => $expire
    ];
    return self::__self__()->create($data);
  }

  public static function updateRequest($email, $oldToken, $newToken){
    $now = new DateTime();
    $expire = ($now->add(new DateInterval('PT300S')))->format('Y-m-d H:i:s');
    RequestPending::__self__()->update(["token" => "'$newToken'", "expire" => "'$expire'"],"email='$email' AND token='$oldToken'");
  }
}
