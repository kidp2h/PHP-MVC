<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class DetailController extends Controller {
  private static self $instance;
  public static string $layout = "main";
  
  public static function hook(){
    parent::setLayout(self::$layout);
  }

  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new DetailController();
    }
    return self::$instance;
  }
  public static function handleDetail(Request $request){
    $id = $request->param("id");
    $productName = $id; //getProductById($id);
    return parent::render("detail",["productName" => $productName]);
  }
}
?>
