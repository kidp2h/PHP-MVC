<?php 
namespace core\QueryBuilder;

use core\interfaces\QueryInterface;

class Select implements QueryInterface{

  private array $from = [];
  private array $fields = [];
  private array $conditions = [];

  public function __construct(array $select) {
    $this->fields = $select;
  }
  public function select(string ...$select): self {
    foreach ($select as $arg) $this->fields[] = $arg;
    return $this;
  }
  public function where(string ...$where): self {
    foreach ($where as $arg) $this->conditions[] = $arg;
    return $this;
  }
  public function from(string $table, ?string $alias = null): self {
    $this->from[] = $alias === null ? $table : "${table} AS ${alias}";
    return $this;
  }
  public function __toString() : string {
    return 'SELECT ' .implode(', ', $this->fields). ' FROM ' . implode(', ', $this->from)
          .($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));
  }

}
?>