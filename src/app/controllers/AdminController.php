<?php
namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Order;
use app\models\User;
use core\Controller;
use core\Request;
use core\Response;
use DateTime;
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
  public static function changeImageCategory(Request $request, Response $response){
    // error_reporting(E_ALL); ini_set('display_errors', 1);
    // ini_set('display_errors', 1);
    $id = $request->param('id');
    $fileName = $_FILES['file']['full_path'];
    $listValidExt = array("jpg","png","jpeg", "svg");
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileExt = strtolower($fileExt);
    if(in_array($fileExt,$listValidExt)){
      $nameUnique = Utils::v4().".$fileExt";
      if(move_uploaded_file($_FILES['file']['tmp_name'],"../public/images/categories/".$nameUnique)){
        Category::__self__()->update(["image" => "/public/images/categories/".$nameUnique],"id=$id");
        return json_encode(["status" => true, "message" => "Change success"]);
      }
    }else return json_encode(["status" => false, "message" => "Only upload image !!"]);
  }
  public static function uploadImageProduct(Request $request, Response $response){
    $id = $request->param('id');
    $body = $request->body();
    $fileName = $_FILES['file']['full_path'];

    $listValidExt = array("jpg","png","jpeg", "svg");
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileExt = strtolower($fileExt);
    if(in_array($fileExt,$listValidExt)){
      $listImage = json_decode($body["listImage"]);
      $nameUnique = Utils::v4().".$fileExt";
      $urlNewImage = "/public/images/products/".$nameUnique;
      $newListImage = [...$listImage, $urlNewImage];
      $indexNewImage = array_search($urlNewImage, $newListImage);
      $newListImage = json_encode($newListImage);
      if(move_uploaded_file($_FILES['file']['tmp_name'],"../public/images/products/".$nameUnique)){
        Product::__self__()->update(["image" => $newListImage],"id=$id");
        return json_encode(["status" => true, "message" => "Upload success", "payload" => $newListImage, "index" => $indexNewImage]);
      }
    }else return json_encode(["status" => false, "message" => "Only upload image !!"]);
  }
  public static function deleteImageProduct(Request $request, Response $response){
    $id = $request->param('id');
    $body = $request->body();
    $newListImage = $body["newListImage"];
    if(isset($body["index"])){
      $index = (int)$body["index"];
      $newListImage = json_decode($newListImage);
      unset($newListImage[(int)$index]);
      $newListImage = json_encode($newListImage);
    }

    Product::__self__()->update(["image" => $newListImage],"id=$id");
    return json_encode(["status" => true, "message" => "Delete image success", "payload" => $newListImage]);
    
  }
  public static function removeProduct(Request $request, Response $response) {
    $id = ($request->body())["id"];
    $now = new DateTime();
    $now = $now->format('Y-m-d H:i:s');
    Product::__self__()->update(["deleted_at" => $now],"id=$id");
    return json_encode(["status" => true, "message" => "Delete product success"]);
  }
  public static function saveProduct(Request $request, Response $response) {
    $body = ($request->body());
    $id = $body["id"];
    $nameProduct = $body["nameProduct"];
    $categoryProduct = $body["categoryProduct"];
    $priceProduct = $body["priceProduct"];
    Product::__self__()->update(["name" => $nameProduct,'category_id' => $categoryProduct, "price" => $priceProduct],"id=$id");
    return json_encode(["status" => true, "message" => "Update product success"]);
  }
  public static function createProduct(Request $request, Response $response){
    $body = ($request->body());
    $nameProduct = $body["nameProduct"];
    $categoryProduct = $body["categoryProduct"];
    $priceProduct = $body["priceProduct"];
    $image = '[\"/public/images/products/product.jpg\"]';
    $result = Product::__self__()->create(["name" => $nameProduct,'category_id' => $categoryProduct, "price" => $priceProduct, "image" => $image]);
    if($result->status)
      return json_encode(["status" => true, "message" => "Create product success !!", "payload" => $result->id]);
    return json_encode(["status" => false, "message" => "Name product is exist !!"]);
  }
}
?>