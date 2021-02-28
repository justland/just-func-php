<?php

namespace JustLand\JustFunc;

class Subtract_Test extends InterpreterTestCase
{
  public function test_requires_at_least_one_arg()
  {
    $this->testEvaluate(null, [ArityMismatch::create('-', [])], ['-']);
  }

  public function test_single_arg_returns_negative_arg()
  {
    $this->testEvaluate(0, null, ['-', 0]);
    $this->testEvaluate(-3, null, ['-', 3]);
  }

  public function test_subtract_two_numbers()
  {
    $this->testEvaluate(1, null, ['-', 3, 2]);
  }

  public function test_multiple_numbers()
  {
    $this->testEvaluate(0, null, ['-', 10, 1, 2, 3, 4]);
  }

  public function test_negative_numbers()
  {
    $this->testEvaluate(2, null, ['-', 1, -1]);
    $this->testEvaluate(0, null, ['-', -1, -1]);
  }

  public function test_not_numeric_returns_null()
  {
    $this->testEvaluate(null, null, ['-', true]);
    $this->testEvaluate(null, null, ['-', '1']);
    $this->testEvaluate(null, null, ['-', null]);
  }
  public function test_nested()
  {
    $this->testEvaluate(3, null, ['-', ['-', 10, 2], ['-', 10, 5]]);
  }
  public function test_ratio()
  {
    $this->testEvaluate(['ratio', -1, 3], null, ['-', ['ratio', 3]]);
    $this->testEvaluate(['ratio', 8, 3], null, ['-', 3, ['ratio', 3]]);
    $this->testEvaluate(['ratio', 8, 3], null, ['-', 3, ['ratio', 3]]);
    $this->testEvaluate(['ratio', -1, 12], null, ['-', ['ratio', 2, 3], ['ratio', 3, 4]]);
  }
}
