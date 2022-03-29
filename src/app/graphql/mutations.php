<?php

namespace app\graphql;

use GraphQL\Type\Definition\ObjectType;

require('mutations/UserMutation.php');

$rootMutation = new ObjectType([
  'name' => 'Mutation',
  'fields' => $userMutation
]);
