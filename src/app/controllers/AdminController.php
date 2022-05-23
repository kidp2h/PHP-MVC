<?php
namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Order;
use app\models\User;
use core\Controller;

class AdminController extends Controller {
  public static string $layout = 'admin';
  public static array $params = [];
  public static array $paramsLayout = [];

  public static function useHook(){
    self::$params = self::$paramsLayout;
  }

  public static function admin(){
    $users = User::__self__()->find(["*"],"1");
    //$product = Product::__self__()->find(["*"], "1");
    //$categories = Category::__self__()->find(["*"],"1");
    return parent::render('admin',["users" => $users/* "products" => $products, "categories" => $categories */]);
  }
  public static function adminStore(){
    $users = User::__self__()->find(["*"],"1");
    //$product = Product::__self__()->find(["*"], "1");
    //$categories = Category::__self__()->find(["*"],"1");
    return parent::render('admin',["users" => $users/* "products" => $products, "categories" => $categories */]);
  }
  public static function product() {

    $products = Product::__self__()->getListProductAllByStoreId();
    $categories = Category::__self__()->getCategoryList();

    $params = array (
      "products" => $products,
      "categories" => $categories
    );


    return parent::render('admin.product', $params);
  }
  public static function productStore(){

    $products = Product::__self__()->getListProductAllByStoreId(self::$params['idStore']);
    $categories = Category::__self__()->getCategoryList();

    $params = array (
      "products" => $products,
      "categories" => $categories
    );

    return parent::render('admin.product', $params);
  }
  public static function category(){

    $categories = Category::__self__()->getCategoryList();

    $params = array (
      "categories" => $categories
    );

    return parent::render('admin.category', $params);
  }
  public static function user(){
    $users = User::__self__()->find(["*"],"1");
    return parent::render('admin.user',["users" => $users]);
  }
  public static function bill(){

    $orders = Order::__self__()->getOrderByStoreId();
    $params = array (
      'orders' => $orders
    );
    return parent::render('admin.bill', $params);
  }
  public static function billStore(){

    $orders = Order::__self__()->getOrderByStoreId(self::$params['idStore']);
    $params = array (
      'orders' => $orders
    );
    return parent::render('admin.bill', $params);
    
  }
  public static function revenue(){
    return parent::render('admin.revenue');
  }
  public static function revenueStore(){
    return parent::render('admin.revenue');
  }
}
?>