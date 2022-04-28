<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class ContactController extends Controller {

  public static function contact(){
    return parent::render('contact');
  }
  public static function handleContact(Request $request){
    if($request->isPassedMiddleware){
      echo "Passing";
    }else{
      echo "Failed";
    }
  }
}
?>