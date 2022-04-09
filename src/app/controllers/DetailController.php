<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class DetailController extends Controller {
  private static self $instance;
  public function __construct() {
    parent::setLayout('main');
  }
  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new DetailController();
    }
    return self::$instance;
  }
  public static function handleDetail(Request $request){
    $id = $request->param("id");
    $productName = "product 1";
    return parent::render("detail",["productName" => $productName]);
  }
}
?>