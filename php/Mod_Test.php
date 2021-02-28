<?php

namespace JustLand\JustFunc;

class Mod_Test extends InterpreterTestCase
{
  public function test_takes_two_args_only()
  {
    $this->testEvaluate(null, [ArityMismatch::create('mod', [])], ['mod']);
    $this->testEvaluate(null, [ArityMismatch::create('mod', [1])], ['mod', 1]);
    $this->testEvaluate(null, [ArityMismatch::create('mod', [1, 2, 3])], ['mod', 1, 2, 3]);
  }

  public function test_mod_by_0_gets_divide_by_zero()
  {
    $this->testEvaluate(null, [DivideByZero::create('mod', [2, 0])], ['mod', 2, 0]);
  }

  public function test()
  {
    $this->testEvaluate(2, null, ['mod', 5, 3]);
    $this->testEvaluate(-2, null, ['mod', -5, 3]);
    $this->testEvaluate(2, null, ['mod', 5, -3]);
  }

  public function test_not_numeric_returns_null()
  {
    $this->testEvaluate(null, [TypeMismatch::create('mod', 0, 'number', true)], ['mod', true, 1]);
    $this->testEvaluate(null, [TypeMismatch::create('mod', 0, 'number', '1')], ['mod', '1', 1]);
    $this->testEvaluate(null, [TypeMismatch::create('mod', 0, 'number', null)], ['mod', null, 1]);

    $this->testEvaluate(null, [TypeMismatch::create('mod', 1, 'number', true)], ['mod', 1, true]);
    $this->testEvaluate(null, [TypeMismatch::create('mod', 1, 'number', '1')], ['mod', 1, '1']);
    $this->testEvaluate(null, [TypeMismatch::create('mod', 1, 'number', null)], ['mod', 1, null]);
  }

  public function test_nested()
  {
    $this->testEvaluate(2, null, ['mod', 5, ['mod', 10, 7]]);
    $this->testEvaluate(2, null, ['mod', ['mod', 12, 7], 3]);
    $this->testEvaluate(2, null, ['mod', ['mod', 12, 7], ['mod', 9, 6]]);
  }

  public function test_ratio()
  {
    $this->testEvaluate(0, null, ['mod', 5, ['ratio', 3]]);
    $this->testEvaluate(['ratio', 1, 3], null, ['mod', 5, ['ratio', 2, 3]]);
    $this->testEvaluate(['ratio', 4, 3], null, ['mod', ['ratio', 10, 3], 2]);
    $this->testEvaluate(['ratio', 5, 6], null, ['mod', ['ratio', 10, 3], ['ratio', 5, 2]]);
  }
}
