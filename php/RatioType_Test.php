<?php

namespace JustLand\JustFunc;

class RatioType_Test extends InterpreterTestCase
{
  public function test_is()
  {
    $this->assertTrue(RatioType::is(['ratio', 1]));
    $this->assertFalse(RatioType::is(0));
    $this->assertFalse(RatioType::is(1.0));
    $this->assertFalse(RatioType::is(null));
    $this->assertFalse(RatioType::is(true));
    $this->assertFalse(RatioType::is('1'));
  }

  public function test_requires_at_least_one_arg()
  {
    $this->testExecute(null, [ArityMismatch::create('ratio', [])], ['ratio']);
  }

  public function test_not_accept_more_than_two_args()
  {
    $this->testExecute(
      null,
      [ArityMismatch::create('ratio', [1, 2, 3])],
      ['ratio', 1, 2, 3]
    );
    $this->testExecute(
      null,
      [ArityMismatch::create('ratio', [1, 2, 3, 4])],
      ['ratio', 1, 2, 3, 4]
    );
  }

  public function test_single_arg_use_as_denominator()
  {
    $this->testEvaluate(['ratio', 1, 3], null, ['ratio', 3]);
  }

  public function test_whole_number_returns_as_literal()
  {
    $this->testEvaluate(1, null, ['ratio', 1]);
    $this->testEvaluate(5, null, ['ratio', 5, 1]);
    $this->testEvaluate(5, null, ['ratio', 10, 2]);
    $this->testEvaluate(-1, null, ['ratio', 1, -1]);
  }

  public function test_ratio_in_numerator()
  {
    $this->testEvaluate(3, null, ['ratio', ['ratio', 3]]);
    $this->testEvaluate(['ratio', 1, 6], null, ['ratio', ['ratio', 3], 2]);
    $this->testEvaluate(['ratio', 1, 9], null, ['ratio', ['ratio', 3], 3]);
  }
  public function test_ratio_in_denominator()
  {
    $this->testEvaluate(3, null, ['ratio', 1, ['ratio', 3]]);
    $this->testEvaluate(['ratio', 6, 4], null, ['ratio', 2, ['ratio', 4, 3]]);
  }
  public function test_ratio_in_both_num_and_denom()
  {
    $this->testEvaluate(['ratio', 3, 2], null, ['ratio', ['ratio', 2], ['ratio', 3]]);
  }
  public function test_evaluate_to_number()
  {
    $this->testExecute(0.5, null, ['ratio', 1, 2]);
  }
  public function test_ratio()
  {
    $this->testEvaluate(['ratio', 6, 5], null, ['+', 1, ['ratio', 1, 5]]);
    $this->testEvaluate(['ratio', 9, 2], null, ['+', ['ratio', 3, 2], 3]);
    $this->testEvaluate(['ratio', 17, 10], null, ['+', ['ratio', 3, 2], ['ratio', 1, 5]]);
  }
}
