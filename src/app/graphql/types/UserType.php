<?php

namespace app\graphql\types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$userType = new ObjectType([
  'name' => 'User',
  'fields' => static fn () => [
    'id' => Type::id(),
    'username' => Type::string(),
    'password' => Type::string(),
    'email' => Type::string(),
    'phoneNumber' => Type::string(),
    'address' => Type::string(),
    'fullName' => Type::string(),
    'isVerified' => Type::boolean(),
    'tokenVerify' => Type::string(),
    'createdAt' => Type::string(),
    'updatedAt' => Type::string()
  ]
]);

class UserType extends ObjectType {
  public function __construct() {
    parent::__construct([
      'name' => 'User',
      'fields' => static fn (): array => [
        'id' => Type::id(),
        'username' => Type::string(),
        'password' => Type::string(),
        'email' => Type::string(),
        'phoneNumber' => Type::string(),
        'address' => Type::string(),
        'fullName' => Type::string(),
        'isVerified' => Type::boolean(),
        'tokenVerify' => Type::string(),
        'createdAt' => Type::string(),
        'updatedAt' => Type::string()
      ],
    ]);
  }
}
