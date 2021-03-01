<?php

namespace JustLand\JustFunc;

class Divide_Test extends InterpreterTestCase
{
  public function test_requires_at_least_one_arg()
  {
    $this->testEvaluate(null, [ArityMismatch::create('/', [])], ['/']);
  }

  public function test_single_0_gets_divide_by_zero()
  {
    $this->testEvaluate(null, [DivideByZero::create('/', [0])], ['/', 0]);
  }

  public function test_any_0_denominator_gets_divide_by_zero()
  {
    $this->testEvaluate(null, [DivideByZero::create('/', [5, 4, 2, 0])], ['/', 5, 4, 2, 0]);
  }

  public function test_single_arg_returns_1_over_value()
  {
    $this->testEvaluate(1, null, ['/', 1]);
    $this->testEvaluate(['ratio', 1, 5], null, ['/', 5]);
    $this->testExecute(0.2, null, ['/', 5]);
  }

  public function test_two_numbers()
  {
    $this->testExecute(1.5, null, ['/', 3, 2]);
  }

  public function test_multiple_numbers()
  {
    $this->testEvaluate(1, null, ['/', 10, 1, 2, 5]);
  }

  public function test_negative_numbers()
  {
    $this->testEvaluate(-1, null, ['/', 1, -1]);
    $this->testEvaluate(1, null, ['/', -1, -1]);
  }

  public function test_not_numeric_returns_null()
  {
    $this->testEvaluate(null, [TypeMismatch::create('/', 0, 'number', true)], ['/', true]);
    $this->testEvaluate(null, [TypeMismatch::create('/', 0, 'number', '1')], ['/', '1']);
    $this->testEvaluate(null, [TypeMismatch::create('/', 0, 'number', null)], ['/', null]);

    $this->testEvaluate(null, [TypeMismatch::create('/', 1, 'number', true)], ['/', 1, true]);
  }
  public function test_nested()
  {
    $this->assertSame(3, $this->testExecuteResult(['/', ['/', 12, 2], ['/', 10, 5]]));
  }
  public function test_ratio()
  {
    $this->testEvaluate(3, null, ['/', ['ratio', 3]]);
    $this->testEvaluate(6, null, ['/', 2, ['ratio', 3]]);
    $this->testEvaluate(['ratio', 3, 2], null, ['/', ['ratio', 2], ['ratio', 3]]);
    $this->testEvaluate(6, null, ['/', ['ratio', 2], ['ratio', 3], ['ratio', 4]]);
  }
}
