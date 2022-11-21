<?php

namespace tests;

use core\Controller;
use core\Request;
use core\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

abstract class BaseTest extends TestCase implements ITestCase
{
  protected MockObject $requestMock;
  protected MockObject $responseMock;
  protected ReflectionClass $controller;
  protected function setUp(): void
  {
    /** @var Request&MockObject $requestMock */
    $this->requestMock = $this->createMock(Request::class);
    /** @var Response&MockObject $responseMock */
    $this->responseMock = $this->createMock(Response::class);
    $this->domainSetup();
  }

  protected function methodRequest(string $method)
  {
    $this->requestMock->expects($this->any())
      ->method('method')
      ->will($this->returnValue($method));
  }

  protected function bodyRequest($value)
  {
    $this->requestMock->expects($this->any())
      ->method('body')
      ->will($this->returnValue($value));
  }

  protected function injectMockModel($controller, $nameVariable, MockObject $mock, callable $action = NULL){
    $this->controller = new ReflectionClass($controller);
    $this->controller->getProperty($nameVariable)->setValue($mock);
    if($action) $action();
    return ["controller" => $this->controller, "class" => $controller ];
  }
  protected function invokeMethod($method, $class) {
    return $this->controller->getMethod($method)->invoke($class, $this->requestMock, $this->responseMock);
  }
  protected function tearDown(): void
  {
    parent::tearDown();
  }
}
