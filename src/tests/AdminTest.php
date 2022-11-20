<?php

namespace tests;

use app\controllers\AdminController;
use app\models\Product;
use PHPUnit\Framework\MockObject\MockObject;
use app\models\User;
use ReflectionClass;
use tests\BaseTest;

class AdminTest extends BaseTest
{

  private MockObject $productMock;


  public function domainSetup()
  {
    /** @var Product&MockObject $productMock */
    $this->productMock = $this->createMock(Product::class);
  }

  /**
   * @dataProvider removeProductProvider
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
      "invalid id" => [12893123, false, '{"status":false,"message":"Wrong id"}'],
      "correct id" => [1, true, '{"status":true,"message":"Delete product success"}']

    ];
  }
}
