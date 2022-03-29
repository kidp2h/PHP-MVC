<?php

namespace app\graphql;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

require('query.php');
require('mutations.php');

try {
  $schema = new Schema([
    'query' => $rootQuery,
    'mutation' => $rootMutation
  ]);

  $rawInput = file_get_contents('php://input');
  if ($rawInput === false) {
    throw new \RuntimeException('Failed to get php://input');
  }

  $input = json_decode($rawInput, true);
  $query = $input['query'];
  $variableValues = $input['variables'] ?? null;

  $rootValue = ['prefix' => 'You said: '];
  $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
  $output = $result->toArray();
} catch (\Exception $e) {
  $output = [
    'error' => [
      'message' => $e->getMessage()
    ]
  ];
}


// header('Content-Type: application/json');
echo json_encode($output);
