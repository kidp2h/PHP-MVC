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


  /**
   * @dataProvider signInProvider
   * @test
   */
  public function testSignIn(string $username, string $password, bool $status, string $expected): void
  {
    // Mocking
    $this->requestMock->expects($this->any())
      ->method('method')
      ->will($this->returnValue("POST"));

    $this->requestMock->expects($this->any())
      ->method('body')
      ->will($this->returnValue(["username" => $username, "password" => $password]));

    $this->userMock->expects($this->any())->method("checkUser")->willReturn((object)["status" => $status, "user" => (object)[
      "id" => 1
    ]]);
    $this->userMock->expects($this->any())->method("update")->willReturn(true);

    // Inject Dependencies
    $controller = new ReflectionClass(AuthController::class);
    $controller->getProperty("userModel")->setValue($this->userMock);
    $controller->getProperty("userModel")->getValue()->setPassword($password);
    $controller->getMethod("handleSignIn")->invoke(new AuthController(), $this->requestMock, $this->responseMock);

    //Assertion
    $this->assertEquals(
      $expected,
      $controller->getMethod("handleSignIn")->invoke(new AuthController(), $this->requestMock, $this->responseMock)
    );
  }

  public function signInProvider(): array
  {
    return [
      "wrong" => ["admin1", "admin1", false, '{"status":false,"message":"Username or password is wrong"}'],
      "correct" => ["admin", "admin", true, '{"status":true,"redirect":"\/"}']
    ];
  }


  /**
   * @dataProvider signUpProvider
   * @test
   */
  public function testSignUp(string $username, string $password, string $email, bool $status, string $expected): void
  {
    // Mocking
    $this->requestMock->expects($this->any())
      ->method('method')
      ->will($this->returnValue("POST"));

    $this->requestMock->expects($this->any())
      ->method('body')
      ->will($this->returnValue(["username" => $username, "password" => $password, "email" => $email, "fullName" => "any"]));

    $this->userMock->expects($this->any())->method("create")->willReturn((object)["status" => $status, "id" => 1]);
    $this->userMock->expects($this->any())->method("update")->willReturn(true);

    // Inject Dependencies
    $controller = new ReflectionClass(AuthController::class);
    $controller->getProperty("userModel")->setValue($this->userMock);
    $controller->getMethod("handleSignUp")->invoke(new AuthController(), $this->requestMock, $this->responseMock);

    //Assertion
    $this->assertEquals(
      $expected,
      $controller->getMethod("handleSignUp")->invoke(new AuthController(), $this->requestMock, $this->responseMock)
    );
  }
  public function signUpProvider(): array
  {
    return [
      "not exist" => ["admin299", "admin299", "admin299@gmail.com", true, '{"status":true,"redirect":"\/signin"}'],
      "exist username" => ["admin", "admin", "asmd@gmail.com", false, '{"status":false,"message":"Username or email is exist"}'],
      "exist email" => ["adm23in", "adm23in", "kidp2h@gmail.com", false, '{"status":false,"message":"Username or email is exist"}']
    ];
  }
  protected function setUp(): void
  {
    /** @var Request&MockObject $requestMock */
    $this->requestMock = $this->createMock(Request::class);
    /** @var Response&MockObject $responseMock */
    $this->responseMock = $this->createMock(Response::class);
    /** @var User&MockObject $userMock */
    $this->userMock = $this->createMock(User::class);
  }
  protected function tearDown(): void
  {
    parent::tearDown();
  }
}
