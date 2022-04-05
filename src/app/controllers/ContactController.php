<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class ContactController extends Controller {

  public static function contact(){
    return Controller::Instance()->render('contact');
  }
  public static function handleContact(Request $request){
    $body = $request->params();
    echo '<pre>';
    var_dump($body);
    echo '</pre>';
    exit;
  }
}
?>