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

  public static function useHook(){
    self::$params = self::$paramsLayout;
  }

  public static function store(){
    $stores = Store::__self__()->getStoreList();
    $params = array (
      'stores' => $stores
    );
    return parent::render('admin.store', $params);
  }

  public static function storeStore(){
    $stores = Store::__self__()->getStoreList(self::$params['idStore']);
    $params = array (
      'stores' => $stores
    );
    return parent::render('admin.store', $params);
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

    return parent::render('admin.product');
  }
  public static function productStore(){


    $products = Product::__self__()->getListProductAllByStoreId(self::$params['idStore']);
    $categories = Category::__self__()->getCategoryList();

    $params = array (
      "products" => $products,
      "categories" => $categories,
      "idStore" => self::$params['idStore']
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
    return parent::render('admin.bill');
  }
  public static function billStore(){
    return parent::render('admin.bill');
  }
  public static function revenue(){
    return parent::render('admin.revenue');
  }
  public static function revenueStore(){
    $revenue = Order::__self__()->getRevenue(self::$params['idStore']);

    $params = array (
      "revenue" => $revenue
    );
    return parent::render('admin.revenue', $params );
  }
}
?>