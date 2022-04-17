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
      $mail->addTo($to["address"]);
      $mail->addContent("text/html", $body);
      $sendgrid = new SendGrid($_ENV['SENDGRID_API_KEY']);
      return $sendgrid->send($mail);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public static function sendMailWithTemplate(array $to, string $subject, array $dataTemplate){
    try {
      $mail = Application::$mail;
      $mail->setFrom($_ENV["FROM_ADDRESS"], $_ENV["FROM_NAME"]);
      $mail->setSubject($subject);
      $mail->addTo($to["address"]);
      $mail->setTemplateId($_ENV["DYNAMIC_TEMPLATE"]);
      $mail->addDynamicTemplateDatas($dataTemplate);
      $sendgrid = new SendGrid($_ENV['SENDGRID_API_KEY']);
      return $sendgrid->send($mail);
    } catch (Exception $e) {
      echo $e->getMessage();
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
  public static function hashBcrypt(string $text){
    return password_hash($text, PASSWORD_BCRYPT, ["cost" => $_ENV["SALT"]]);
  }
  public static function verifyBcrypt(string $hash, string $text){
    return password_verify($text,$hash);
  }

  public static function verifyCaptcha(string $responseCaptcha){
    $curl = curl_init("https://www.google.com/recaptcha/api/siteverify");
    curl_setopt_array($curl,[
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => http_build_query([
        'secret' => $_ENV["GC_SECRET_KEY"],
        'response' => $responseCaptcha
      ])
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
  }

  public static function v4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

      // 32 bits for "time_low"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }
}
