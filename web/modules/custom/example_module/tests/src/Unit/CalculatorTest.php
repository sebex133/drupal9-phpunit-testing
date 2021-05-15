<?php

namespace Drupal\Tests\contact\Unit;

use PHPUnit\Framework\TestCase;
use Drupal\example_module\Calculator;

/**
 * Test unit of example_module Calculator
 *
 * @group example_module_unit
 */
class CalculatorTest extends TestCase
{
  private $calculator;

  public function setUp() : void{
    $this->calculator = new Calculator();
  }

  public function testAdd(){
    $this->calculator->setOperands(
      [5,28]
    );
    $this->assertEquals(
      33,
      $this->calculator->add()
    );
  }
}
