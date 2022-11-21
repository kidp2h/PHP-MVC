<?php

namespace tests;

use app\controllers\AdminController;
use app\models\Category;
use app\models\Product;
use app\models\User;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;
use tests\BaseTest;

class AdminTest extends BaseTest
{

  private MockObject $productMock;
  private MockObject $categoryMock;
  private MockObject $userMock;


  public function domainSetup()
  {
    /** @var Product&MockObject $productMock */
    $this->productMock = $this->createMock(Product::class);
    /** @var Category&MockObject $categoryMock */
    $this->categoryMock = $this->createMock(Category::class);
    /** @var User&MockObject $userMock */
    $this->userMock = $this->createMock(User::class);
  }

  /**
   * @dataProvider removeProductProvider
   * @test
   */

  public function testRemoveProduct(int $number, bool $status, string $expected)
  {
    $this->methodRequest("POST");

    $this->bodyRequest(["id" => $number]);

    if ($status) {
      $this->productMock->expects($this->any())->method("update")->willReturn(true);
    } else {
      $this->productMock->expects($this->any())->method("update")->willReturn((object)["message" => "Wrong id", "status" => false]);
    }

    // Inject Dependencies
    $controller = new ReflectionClass(AdminController::class);
    $controller->getProperty("productModel")->setValue($this->productMock);
    $result = $controller->getMethod("removeProduct")->invoke(new AdminController(), $this->requestMock, $this->responseMock);

    $this->assertEquals(
      $expected,
      $result
    );
  }

  public function removeProductProvider(): array
  {
    return [
      "invalid product id" => [12893123, false, '{"status":false,"message":"Wrong id"}'],
      "correct product id" => [1, true, '{"status":true,"message":"Delete product success"}']

    ];
  }

  /**
   * @dataProvider removeCategoryProvider
   * @test
   */
  public function testRemoveCategory(int $number, bool $status, string $expected)
  {
    $this->methodRequest("POST");

    $this->bodyRequest(["id" => $number]);

    if ($status) {
      $this->categoryMock->expects($this->any())->method("update")->willReturn(true);
    } else {
      $this->categoryMock->expects($this->any())->method("update")->willReturn((object)["message" => "Wrong id", "status" => false]);
    }

    // Inject Dependencies
    $controller = new ReflectionClass(AdminController::class);
    $controller->getProperty("categoryModel")->setValue($this->categoryMock);
    $result = $controller->getMethod("removeCategory")->invoke(new AdminController(), $this->requestMock, $this->responseMock);

    $this->assertEquals(
      $expected,
      $result
    );
  }

  public function removeCategoryProvider(): array
  {
    return [
      "invalid category id" => [2873, false, '{"status":false,"message":"Wrong id"}'],
      "correct category id" => [1, true, '{"status":true,"message":"Delete category success"}']
    ];
  }
  /**
   * @dataProvider createProductProvider
   * @test
   */
  public function testCreateProduct(string $nameProduct, $category, $price, $status, $expected)
  {
    $this->methodRequest("POST");

    $this->bodyRequest(["nameProduct" => $nameProduct, "categoryProduct" => $category, "priceProduct" => $price]);

    if ($status) {
      $this->productMock->expects($this->any())->method("create")->willReturn((object)["id" => 1, "status" => true]);
    } else {
      $this->productMock->expects($this->any())->method("create")->willReturn((object)["status" => false]);
    }

    $this->injectMockModel(AdminController::class,"productModel",$this->productMock);
    $result = $this->invokeMethod("createProduct",new AdminController);
    $this->assertEquals(
      $expected,
      $result
    );
  }

  public function createProductProvider(): array
  {
    return [
      "name product is exist" => ["Iphone 12", "1", "12367", false, '{"status":false,"message":"Name product is exist or category not exist !!"}'],
      "success" => ["Iphone 13", "1", "12367", true, '{"status":true,"message":"Create product success !!","payload":1}'],
      "category is not exist" => ["Iphone14", "123213213", "23621", false, '{"status":false,"message":"Name product is exist or category not exist !!"}']
    ];
  }


    /**
   * @dataProvider createUserProvider
   * @test
   */
  public function testCreateUser(string $fullName, $username, $email, $address, $phoneNumber, $status, $expected)
  {
    $this->methodRequest("POST");

    $this->bodyRequest(["username" => $username, "email" => $email, "fullName" => $fullName, "phoneNumber" => $phoneNumber, "address" => $address, "permission" => 0]);

    if ($status) {
      $this->userMock->expects($this->any())->method("create")->willReturn((object)["id" => 1, "status" => true]);
    } else {
      $this->userMock->expects($this->any())->method("create")->willReturn((object)["status" => false]);
    }

    $this->injectMockModel(AdminController::class,"userModel",$this->userMock);
    $result = $this->invokeMethod("createUser",new AdminController);
    $this->assertEquals(
      $expected,
      $result
    );
  }

  public function createUserProvider(): array
  {
    return [
      "username is exist" => ["Nguyen Van A", "usernameA", "emailA@gmail.com", "any","0999999999", false, '{"status":false,"message":"Username or email is exist !!"}'],
      "email is exist" => ["Nguyen Van C", "usernameC", "emailA@gmail.com","any", "0999999999", false, '{"status":false,"message":"Username or email is exist !!"}'],
      "success" => ["Nguyen Van B", "usernameB", "emailB@gmail.com", true, "any","0999999999", '{"status":true,"message":"Create user success !!","payload":1}'],
    ];
  }

    /**
   * @dataProvider createCategoryProvider
   * @test
   */
  public function testCreateCategory($name, $status, $expected)
  {
    $this->methodRequest("POST");

    $this->bodyRequest(["nameCategory" => $name]);

    if ($status) {
      $this->categoryMock->expects($this->any())->method("create")->willReturn((object)["id" => 1, "status" => true]);
    } else {
      $this->categoryMock->expects($this->any())->method("create")->willReturn((object)["status" => false]);
    }

    $this->injectMockModel(AdminController::class,"categoryModel",$this->categoryMock);
    $result = $this->invokeMethod("createCategory",new AdminController);
    $this->assertEquals(
      $expected,
      $result
    );
  }

  public function createCategoryProvider(): array
  {
    return [
      "category is exist" => ["Laptop", false, '{"status":false,"message":"Name category is exist !!"}'],
      "success" => ["Headphone", true,  '{"status":true,"message":"Create category success !!","payload":1}'],
    ];
  }
}
