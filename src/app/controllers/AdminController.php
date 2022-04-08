<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class AdminController extends Controller {
  private static self $instance;
  public function __construct() {
    parent::setLayout('admin');
  }
  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new AdminController();
    }
    return self::$instance;
  }

  public static function admin(){
    parent::setLayout('admin');
    return parent::render('admin');
  }
}
?>