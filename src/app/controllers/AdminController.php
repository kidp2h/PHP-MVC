<?php
namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Order;
use app\models\Store;
use app\models\User;
use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use utils\Utils;

class AdminController extends Controller {
  public static string $layout = 'admin';
  public static array $params = [];
  public static array $paramsLayout = [];

  public static function useHook(){
    self::$params = self::$paramsLayout;
  }

  public static function admin(){
    $users = User::__self__()->find(["*"],"1");
    $categories = Category::__self__()->find(["*"],"1");
    $products = Product::__self__()->getEntireProduct();
    return parent::render('admin',["users" => $users, "categories" => $categories ,"products" => $products]);
  }

  public static function adminStore(){
    $users = User::__self__()->find(["*"],"1");
    $categories = Category::__self__()->find(["*"],"1");
    $products = Product::__self__()->getEntireProduct();
    //$categories = Category::__self__()->find(["*"],"1");
    return parent::render('admin',["users" => $users, "categories" => $categories,"products" => $products]);
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

  public static function store(){
    $stores = Store::__self__()->getStoreList();
    $params = array (
      'stores' => $stores
    );
    return parent::render('admin.store', $params);
  }

  public static function changeImageCategory(Request $request, Response $response){
    error_reporting(E_ALL); ini_set('display_errors', 1);
    ini_set('display_errors', 1);
    $id = $request->param('id');
    $fileName = $_FILES['file']['full_path'];
    $listValidExt = array("jpg","png","jpeg");
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileExt = strtolower($fileExt);
    if(in_array($fileExt,$listValidExt)){
      $nameUnique = Utils::v4().".$fileExt";
      if(move_uploaded_file($_FILES['file']['tmp_name'], Application::$__ROOT_DIR__."/public/images/categories/".$nameUnique)){
        Category::__self__()->update(["image" => "/public/images/categories/".$nameUnique],"id=$id");
        return json_encode(["status" => true, "message" => "Change success"]);
      }
    }else return json_encode(["status" => false, "message" => "Only upload image !!"]);
  }
}
?>