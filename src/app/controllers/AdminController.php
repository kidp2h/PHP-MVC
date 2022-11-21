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

class AdminController extends Controller
{
  public static string $layout = 'admin';
  public static array $params = [];
  public static array $paramsLayout = [];
  public static ?Product $productModel = NULL;
  public static ?Category $categoryModel = NULL;
  public static ?User $userModel = NULL;

  public static function useHook()
  {
    $users = User::__self__()->find(["*"], "1");
    $categories = Category::__self__()->find(["*"], "1");
    $products = Product::__self__()->getEntireProduct();
    $orders = Order::__self__()->getEntireOrders();
    $params = ["users" => $users, "categories" => $categories, "products" => $products, "orders" => $orders];
    self::$params = self::$paramsLayout;
    self::$params = [...self::$params, ...$params];
  }

  public static function admin()
  {
    return parent::render('admin',);
  }

  public static function product()
  {

    $products = Product::__self__()->getEntireProduct();
    $categories = Category::__self__()->getCategoryList();

    $params = array(
      "products" => $products,
      "categories" => $categories
    );


    return parent::render('admin.product', $params);
  }

  public static function category()
  {

    $categories = Category::__self__()->getCategoryList();

    $params = array(
      "categories" => $categories
    );

    return parent::render('admin.category', $params);
  }
  public static function user()
  {
    $users = User::__self__()->find(["*"], "1");
    return parent::render('admin.user', ["users" => $users]);
  }
  public static function bill()
  {

    $orders = Order::__self__()->getEntireOrders();
    $params = array(
      'orders' => $orders
    );
    return parent::render('admin.bill', $params);
  }

  public static function revenue()
  {
    $revenue = Order::__self__()->getRevenue();

    $params = array(
      "revenue" => $revenue
    );
    return parent::render('admin.revenue', $params);
  }
  public static function revenueStore()
  {
    $revenue = Order::__self__()->getRevenue(self::$params['idStore']);

    $params = array(
      "revenue" => $revenue
    );
    return parent::render('admin.revenue', $params);
  }
  public static function changeImageCategory(Request $request, Response $response)
  {
    $id = $request->param('id');
    $fileName = $_FILES['file']['full_path'];
    $listValidExt = array("jpg", "png", "jpeg", "svg");
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileExt = strtolower($fileExt);
    if (in_array($fileExt, $listValidExt)) {
      $nameUnique = Utils::v4() . ".$fileExt";
      if (move_uploaded_file($_FILES['file']['tmp_name'], "../public/images/categories/" . $nameUnique)) {
        Category::__self__()->update(["image" => "/public/images/categories/" . $nameUnique], "id=$id");
        return json_encode(["status" => true, "message" => "Change success"]);
      }
    } else return json_encode(["status" => false, "message" => "Only upload image !!"]);
  }
  public static function uploadImageProduct(Request $request, Response $response)
  {
    $id = $request->param('id');
    $body = $request->body();
    $fileName = $_FILES['file']['full_path'];

    $listValidExt = array("jpg", "png", "jpeg", "svg");
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileExt = strtolower($fileExt);
    if (in_array($fileExt, $listValidExt)) {
      $listImage = json_decode($body["listImage"]);
      $nameUnique = Utils::v4() . ".$fileExt";
      $urlNewImage = "/public/images/products/" . $nameUnique;
      $newListImage = [...$listImage, $urlNewImage];
      $indexNewImage = array_search($urlNewImage, $newListImage);
      $newListImage = json_encode($newListImage);
      if (move_uploaded_file($_FILES['file']['tmp_name'], "../public/images/products/" . $nameUnique)) {
        Product::__self__()->update(["image" => $newListImage], "id=$id");
        return json_encode(["status" => true, "message" => "Upload success", "payload" => $newListImage, "index" => $indexNewImage]);
      }
    } else return json_encode(["status" => false, "message" => "Only upload image !!"]);
  }
  public static function deleteImageProduct(Request $request, Response $response)
  {
    $id = $request->param('id');
    $body = $request->body();
    $newListImage = $body["newListImage"];
    if (isset($body["index"])) {
      $index = (int)$body["index"];
      $newListImage = json_decode($newListImage);
      unset($newListImage[(int)$index]);
      $newListImage = json_encode($newListImage);
    }

    Product::__self__()->update(["image" => $newListImage], "id=$id");
    return json_encode(["status" => true, "message" => "Delete image success", "payload" => $newListImage]);
  }
  public static function removeProduct(Request $request, Response $response)
  {
    if (!self::$productModel)
      self::$productModel = Product::__self__();

    $id = ($request->body())["id"];
    $now = new DateTime();
    $now = $now->format('Y-m-d H:i:s');
    $result = self::$productModel->update(["deleted_at" => $now], "id=$id");

    if (isset($result->status) && $result->status === false)
      return json_encode(["status" => false, "message" => "Wrong id"]);
    else
      return json_encode(["status" => true, "message" => "Delete product success"]);
  }
  public static function saveProduct(Request $request, Response $response)
  {
    $body = ($request->body());
    $id = $body["id"];
    $nameProduct = $body["nameProduct"];
    $categoryProduct = $body["categoryProduct"];
    $priceProduct = $body["priceProduct"];
    Product::__self__()->update(["name" => $nameProduct, 'category_id' => $categoryProduct, "price" => $priceProduct], "id=$id");
    return json_encode(["status" => true, "message" => "Update product success"]);
  }
  public static function createProduct(Request $request, Response $response)
  {
    if (!self::$productModel)
      self::$productModel = Product::__self__();
    $body = ($request->body());
    $nameProduct = $body["nameProduct"];
    $categoryProduct = $body["categoryProduct"];
    $priceProduct = $body["priceProduct"];
    $image = '[\"/public/images/products/product.jpg\"]';
    $result = self::$productModel->create(["name" => $nameProduct, 'category_id' => $categoryProduct, "price" => $priceProduct, "image" => $image]);
    if ($result->status)
      return json_encode(["status" => true, "message" => "Create product success !!", "payload" => $result->id]);
    return json_encode(["status" => false, "message" => "Name product is exist or category not exist !!"]);
  }
  public static function saveProductStore(Request $request, Response $response)
  {
    $body = ($request->body());
    $storeId = $request->param('id');
    $productId = $body["productId"];
    $discountProduct = $body["discountProduct"];
    $quantityProduct = $body["quantityProduct"];
    Product::__self__()->updateProductStore($discountProduct, $quantityProduct, $productId, $storeId);
    return json_encode(["status" => true, "message" => "Update product success"]);
  }
  public static function removeProductStore(Request $request, Response $response)
  {
    $body = ($request->body());
    $productId = $body["productId"];
    $storeId = $request->param('id');
    Product::__self__()->removeProductStore($storeId, $productId);
    return json_encode(["status" => true, "message" => "Remove product success"]);
  }

  public static function removeCategory(Request $request, Response $response)
  {
    if (!self::$categoryModel)
      self::$categoryModel = Category::__self__();
    $id = ($request->body())["id"];
    $now = new DateTime();
    $now = $now->format('Y-m-d H:i:s');
    $result = self::$categoryModel->update(["deleted_at" => $now], "id=$id");


    if (isset($result->status) && $result->status === false)
      return json_encode(["status" => false, "message" => "Wrong id"]);
    else
      return json_encode(["status" => true, "message" => "Delete category success"]);
  }
  public static function saveCategory(Request $request, Response $response)
  {
    $body = ($request->body());
    $id = $body["id"];
    $nameCategory = $body["nameCategory"];
    Category::__self__()->update(["title" => $nameCategory], "id=$id");
    return json_encode(["status" => true, "message" => "Update category success"]);
  }
  public static function createCategory(Request $request, Response $response)
  {
    if (!self::$categoryModel)
      self::$categoryModel = Category::__self__();
    $body = ($request->body());
    $nameCategory = $body["nameCategory"];
    $image = "/public/images/products/product.jpg";
    $result = self::$categoryModel->create(["title" => $nameCategory, 'image' => $image]);
    if ($result->status)
      return json_encode(["status" => true, "message" => "Create category success !!", "payload" => $result->id]);
    return json_encode(["status" => false, "message" => "Name category is exist !!"]);
  }
  public static function handleProductRemoveCategory(Request $request, Response $response)
  {
    $body = ($request->body());
    $id = $body["id"];
    Product::__self__()->update(["category_id" => 0], "category_id=$id");
    return json_encode(["status" => true]);
  }

  public static function saveUser(Request $request, Response $response)
  {
    $body = ($request->body());
    $id = $body["id"];
    $permission = $body["permission"];
    User::__self__()->update(["permission" => $permission], "id=$id");
    return json_encode(["status" => true, "message" => "Update user success"]);
  }
  public static function createUser(Request $request, Response $response)
  {
    if (!self::$userModel)
      self::$userModel = User::__self__();
    $body = ($request->body());
    $fullName = $body["fullName"];
    $username = $body["username"];
    $password = Utils::hashBcrypt("admin");
    $email = $body["email"];
    $address = $body["address"];
    $phoneNumber = $body["phoneNumber"];
    $permission = $body["permission"];
    $result = self::$userModel->create(["username" => $username, 'password' => $password, "email" => $email, "fullName" => $fullName, "phoneNumber" => $phoneNumber, "address" => $address, "isVerified" => 1, "isActivePhone" => 1, "type" => "local", "tokenVerify" => Utils::v4(), "permission" => $permission]);
    if ($result->status)
      return json_encode(["status" => true, "message" => "Create user success !!", "payload" => $result->id]);
    return json_encode(["status" => false, "message" => "Username or email is exist !!"]);
  }
}
