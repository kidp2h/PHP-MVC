<?php

namespace app\graphql\mutations;

use App\Models\User;
use GraphQL\Type\Definition\Type;

$userMutation = [
  'sum' => [
    'type' => Type::int(),
    'args' => [
      'x' => ['type' => Type::int()],
      'y' => ['type' => Type::int()],
    ],
    'resolve' => static fn ($_, array $args) => $args['x'] + $args['y'],
  ],
];
