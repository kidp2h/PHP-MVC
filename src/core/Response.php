<?php

namespace core;

class Response {
  public function statusCode(int $statusCode) {
    http_response_code($statusCode);
  }
}
