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
use DateTime;
use utils\Utils;

class AdminController extends Controller {
  public static string $layout = 'admin';
  public static array $params = [];
  public static array $paramsLayout = [];

  public static function useHook(){
    $users = User::__self__()->find(["*"],"1");
    $categories = Category::__self__()->find(["*"],"1");
    $products = Product::__self__()->getEntireProduct();
    $orders = Order::__self__()->getEntireOrders();
    $params = ["users" => $users, "categories" => $categories ,"products" => $products, "orders" => $orders];
    self::$params = self::$paramsLayout;
    self::$params = [...self::$params, ...$params];
  }

  public static function admin(){
    return parent::render('admin',);
  }

  public static function adminStore(){
    return parent::render('admin');
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
    $stores = Store::__self__()->getStoreList();
    return parent::render('admin.user',["users" => $users, "stores" => $stores]);
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
    $revenue = Order::__self__()->getRevenue();

    $params = array (
      "revenue" => $revenue
    );
    return parent::render('admin.revenue', $params );
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
    // error_reporting(E_ALL); ini_set('display_errors', 1);
    // ini_set('display_errors', 1);
    $id = $request->param('id');
    $fileName = $_FILES['file']['full_path'];
    $listValidExt = array("jpg","png","jpeg", "svg");
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
  public static function saveProductStore(Request $request, Response $response){
    $body = ($request->body());
    $storeId = $request->param('id');
    $productId = $body["productId"];
    $discountProduct = $body["discountProduct"];
    $quantityProduct = $body["quantityProduct"];
    Product::__self__()->updateProductStore($discountProduct, $quantityProduct, $productId, $storeId);
    return json_encode(["status" => true, "message" => "Update product success"]);
  }
  public static function removeProductStore(Request $request, Response $response){
    $body = ($request->body());
    $productId = $body["productId"];
    $storeId = $request->param('id');
    Product::__self__()->removeProductStore($storeId, $productId);
    return json_encode(["status" => true, "message" => "Remove product success"]);
  }

  public static function removeCategory(Request $request, Response $response) {
    $id = ($request->body())["id"];
    $now = new DateTime();
    $now = $now->format('Y-m-d H:i:s');
    Category::__self__()->update(["deleted_at" => $now],"id=$id");
    return json_encode(["status" => true, "message" => "Delete category success"]);
  }
  public static function saveCategory(Request $request, Response $response) {
    $body = ($request->body());
    $id = $body["id"];
    $nameCategory = $body["nameCategory"];
    Category::__self__()->update(["title" => $nameCategory],"id=$id");
    return json_encode(["status" => true, "message" => "Update category success"]);
  }
  public static function createCategory(Request $request, Response $response){
    $body = ($request->body());
    $nameCategory = $body["nameCategory"];
    $image = "/public/images/products/product.jpg";
    $result = Category::__self__()->create(["title" => $nameCategory,'image' => $image]);
    if($result->status)
      return json_encode(["status" => true, "message" => "Create category success !!", "payload" => $result->id]);
    return json_encode(["status" => false, "message" => "Name category is exist !!"]);
  }
  public static function handleProductRemoveCategory(Request $request, Response $response){
    $body = ($request->body());
    $id = $body["id"];
    Product::__self__()->update(["category_id" => 0],"category_id=$id");
    return json_encode(["status" => true]);
  }

  public static function saveUser(Request $request, Response $response) {
    $body = ($request->body());
    $id = $body["id"];
    $permission = $body["permission"];
    User::__self__()->update(["permission" => $permission],"id=$id");
    return json_encode(["status" => true, "message" => "Update user success"]);
  }
  public static function createUser(Request $request, Response $response){
    $body = ($request->body());
    $fullName = $body["fullName"];
    $username = $body["fullName"];
    $password = Utils::hashBcrypt("admin");
    $email = $body["email"];
    $address = $body["address"];
    $phoneNumber = $body["phoneNumber"];
    $permission = $body["permission"];
    $result = User::__self__()->create(["username" => $username,'password' => $password, "email" => $email, "fullName" => $fullName, "phoneNumber" => $phoneNumber, "address" => $address, "isVerified" => 1, "isActivePhone" => 1, "type" => "local", "tokenVerify" => Utils::v4(), "permission" => $permission]);
    if($result->status)
      return json_encode(["status" => true, "message" => "Create user success !!", "payload" => $result->id]);
    return json_encode(["status" => false, "message" => "User is exist !!"]);
  }
}
?>