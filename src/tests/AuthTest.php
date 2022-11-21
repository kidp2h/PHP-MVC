<?php

namespace tests;

use app\controllers\AuthController;
use PHPUnit\Framework\MockObject\MockObject;
use app\models\User;
use tests\BaseTest;
use ReflectionClass;

class AuthTest extends BaseTest {
  private MockObject $userMock;

  public function domainSetup() {
    /** @var User&MockObject $userMock */
    $this->userMock = $this->createMock(User::class);
  }
  /**
   * @dataProvider signInProvider
   * @test
   * @group testSignIn
   */
  public function testSignIn(string $username, string $password, bool $status, string $expected): void {
    // Mocking
    $this->methodRequest("POST");

    $this->bodyRequest(["username" => $username, "password" => $password]);

    $this->userMock->expects($this->any())->method("checkUser")->willReturn((object)["status" => $status, "user" => (object)[
      "id" => 1
    ]]);
    $this->userMock->expects($this->any())->method("update")->willReturn(true);

    $this->injectMockModel(
      AuthController::class,
      "userModel",
      $this->userMock,
      fn () =>
      $this->controller->getProperty("userModel")->getValue()->setPassword($password)
    );
    $result = $this->invokeMethod("handleSignIn", new AuthController);

    //Assertion
    $this->assertEquals(
      $expected,
      $result
    );
  }

  public function signInProvider(): array {
    return [
      "wrong" => ["admin1", "admin1", false, '{"status":false,"message":"Username or password is wrong"}'],
      "correct" => ["admin", "admin", true, '{"status":true,"redirect":"\/"}']
    ];
  }


  /**
   * @dataProvider signUpProvider
   * @test
   * @group testSignUp
   */
  public function testSignUp(string $username, string $password, string $email, bool $status, string $expected): void {
    // Mocking
    $this->requestMock->expects($this->any())
      ->method('method')
      ->will($this->returnValue("POST"));

    $this->methodRequest("POST");

    $this->bodyRequest(["username" => $username, "password" => $password, "email" => $email, "fullName" => "any"]);

    $this->userMock->expects($this->any())->method("create")->willReturn((object)["status" => $status, "id" => 1]);
    $this->userMock->expects($this->any())->method("update")->willReturn(true);

    // Inject Dependencies
    $this->injectMockModel(AuthController::class, "userModel", $this->userMock);
    $result = $this->invokeMethod("handleSignUp", new AuthController);

    //Assertion
    $this->assertEquals(
      $expected,
      $result
    );
  }
  public function signUpProvider(): array {
    return [
      "not exist" => ["admin299", "admin299", "admin299@gmail.com", true, '{"status":true,"redirect":"\/signin"}'],
      "exist username" => ["admin", "admin", "asmd@gmail.com", false, '{"status":false,"message":"Username or email is exist"}'],
      "exist email" => ["adm23in", "adm23in", "kidp2h@gmail.com", false, '{"status":false,"message":"Username or email is exist"}']
    ];
  }
}
