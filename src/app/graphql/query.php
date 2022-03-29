<?php

namespace app\graphql;

use app\models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use graphql\mutations\UserType;

$rootQuery = new ObjectType([
  'name' => 'Query',
  'fields' => [
    'user' => [
      'type' => new UserType(),
      'args' => [
        'id' => ['type' => Type::int()],
      ],
      'resolve' => static fn ($user, $args) => User::__self__()->read(["*"], "id=" . $args['id'])
    ],
  ],
]);
