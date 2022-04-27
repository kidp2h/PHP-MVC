<?php
namespace app\controllers;

use core\Controller;
use core\Request;

class AdminController extends Controller {
  public static string $layout = 'admin';


  public static function admin(){
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