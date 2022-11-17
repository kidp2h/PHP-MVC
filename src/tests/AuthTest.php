<?php

namespace tests;

use app\controllers\AuthController;
use core\Request;
use core\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use app\models\User;
use ReflectionClass;

class AuthTest extends TestCase
{
  private MockObject $requestMock;
  private MockObject $responseMock;
  private MockObject $userMock;

  public function testValidUser(): void
  {
    // Mocking
    /** @var Request&MockObject $requestMock */
    $this->requestMock = $this->createMock(Request::class);
    /** @var Response&MockObject $responseMock */
    $this->responseMock = $this->createMock(Response::class);
    /** @var User&MockObject $userMock */
    $this->userMock = $this->createMock(User::class);

    // setup
    $this->requestMock->expects($this->any())
      ->method('method')
      ->will($this->returnValue("POST"));

    $this->requestMock->expects($this->any())
      ->method('body')
      ->will($this->returnValue(["username" => "admin", "password" => "admin"]));

    $this->userMock->expects($this->any())->method("checkUser")->willReturn((object)["status" => true, "user" => (object)[
      "id" => 1
    ]]);
    $this->userMock->expects($this->any())->method("update")->willReturn(true);

    // Inject Dependencies
    $controller = new ReflectionClass(AuthController::class);
    $controller->getProperty("userModel")->setValue($this->userMock);
    $controller->getProperty("userModel")->getValue()->setPassword("admin");
    $controller->getMethod("handleSignIn")->invoke(new AuthController(), $this->requestMock, $this->responseMock);

    //Assertion
    $this->assertEquals(
      '{"status":true,"redirect":"\/"}',
      $controller->getMethod("handleSignIn")->invoke(new AuthController(), $this->requestMock, $this->responseMock)
    );
  }
}
