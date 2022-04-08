<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class TestController extends Controller {

  public static function test(){
    return parent::render("test",["id" => 5]);
  }
  public static function handleContact(Request $request){
    
  }
}
?>