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
    $expire->add(new \DateInterval('PT300S'));
    $data = "{$phone}.{$otp}.{$expire}";
    $hash = crypt($data,$_ENV['SALT']);
    $resultHash = "{$hash}.{$expire}";
    return $resultHash;
  }
  public static function verifyOTP($phone, $hash, $otp){


  }

}
