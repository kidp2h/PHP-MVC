<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class AdminController extends Controller {
  private static self $instance;
  public static string $layout = 'admin';

  public static function Instance(){
    if(!isset(self::$instance)){
      self::$instance = new AdminController();
    }
    return self::$instance;
  }

  public static function admin(){
    //parent::setLayout('admin');
    return parent::render('admin');
  }
  public static function product(){
    return parent::render('admin.product');
  }
  public static function category(){
    return parent::render('admin.category');
  }
  public static function user(){
    return parent::render('admin.user');
  }
  public static function bill(){
    return parent::render('admin.bill');
  }
  public static function revenue(){
    return parent::render('admin.revenue');
  }
}
?>