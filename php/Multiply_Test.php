<?php

namespace JustLand\JustFunc;

class Multiply_Test extends InterpreterTestCase
{
  public function test_no_arg_returns_1()
  {
    $this->testEvaluate(1, null, ['*']);
  }
  public function test_single_arg_returns_arg()
  {
    $this->testEvaluate(0, null, ['*', 0]);
    $this->testEvaluate(3, null, ['*', 3]);
  }
  public function test_multiple_args()
  {
    $this->testEvaluate(24, null, ['*', 1, 2, 3, 4]);
  }
  public function test_negative_numbers()
  {
    $this->testEvaluate(-2, null, ['*', 1, -2]);
  }
  public function test_not_numeric_gets_null()
  {
    $this->testEvaluate(null, null, ['*', true]);
    $this->testEvaluate(null, null, ['*', '1']);
    $this->testEvaluate(null, null, ['*', null]);
  }
  public function test_nested()
  {
    $this->testEvaluate(72, null, ['*', ['*', 2, 3], ['*', 3, 4]]);
  }
  public function test_ratio()
  {
    $this->testEvaluate(['ratio', 1, 3], null, ['*', ['ratio', 3]]);
    $this->testEvaluate(['ratio', 2, 3], null, ['*', ['ratio', 3], 2]);
    $this->testEvaluate(['ratio', 2, 3], null, ['*', 2, ['ratio', 3]]);
    $this->testEvaluate(['ratio', 12, 10], null, ['*', ['ratio', 3, 2], ['ratio', 4, 5]]);
  }
}
