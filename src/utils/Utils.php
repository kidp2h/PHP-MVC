<?php

namespace utils;

use core\Application;
use Exception;
use SendGrid;

class Utils {
  public static function sendMail(array $to, $subject, $body) {
    try {
      $mail = Application::$mail;
      $mail->setFrom($_ENV["FROM_ADDRESS"], $_ENV["FROM_NAME"]);
      $mail->setSubject($subject);
      $mail->addTo($to["address"], $to["name"]);
      $mail->addContent("text/html", $body);
      $sendgrid = new SendGrid($_ENV['SENDGRID_API_KEY']);
      return $sendgrid->send($mail);
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  public static function generateOTP($phone){
    $otp = rand(000000,999999);
    $expire = new \DateTime();
    $expire = $expire->add(new \DateInterval('PT300S'));
    $expire = $expire->getTimestamp();
    $data = "{$phone}.{$otp}.{$expire}";
    $hash = hash_hmac("sha256",$data, $_ENV['SECRET_KEY']);;
    $hashOTP = "{$hash}.{$expire}";
    return [$otp,$hashOTP];
  }
  public static function verifyOTP($phone, $hash, $otp){
    $hashOTP = explode(".",$hash);
    $hashValue = $hashOTP[0];
    $expire = $hashOTP[1]; 
    $now = new \DateTime();
    if($now->getTimestamp() > (int)$expire) return false;
    $data = "{$phone}.{$otp}.{$expire}";
    $newHash = hash_hmac("sha256",$data, $_ENV['SECRET_KEY']);
    $newHashOTP = "{$newHash}.{$expire}";
    echo $newHashOTP;
    if($newHash === $hashValue) return true;
    return false;
  }

}
