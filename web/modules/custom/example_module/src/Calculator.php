<?php
namespace Drupal\example_module;

class Calculator
{
  private $operands;
  public function setOperands(array $operands)
  {
    $this->operands = $operands;
  }
  public function add()
  {
    return array_sum($this->operands) + 3;
  }
}
