<?php
namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\User;
use core\Controller;
use core\Request;
use core\Response;

class AdminController extends Controller {
  public static string $layout = 'admin';
  public static array $params = [];
  public static array $paramsLayout = [];


  public static function admin(){
    $users = User::__self__()->find(["*"],"1");
    $products = Product::__self__()->find(["*"], "1");
    $categories = Category::__self__()->find(["*"], "1");
    return parent::render('admin',["users" => $users, "products" => $products, "categories" => $categories]);
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