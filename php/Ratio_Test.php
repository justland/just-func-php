<?php

namespace JustLand\JustFunc;

class Ratio_Test extends InterpreterTestCase
{
  public function test_isRatio()
  {
    $this->assertTrue(Ratio::isRatio(['ratio', 1]));
    $this->assertFalse(Ratio::isRatio(0));
    $this->assertFalse(Ratio::isRatio(1.0));
    $this->assertFalse(Ratio::isRatio(null));
    $this->assertFalse(Ratio::isRatio(true));
    $this->assertFalse(Ratio::isRatio('1'));
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
    $this->assertEquals(['ratio', 1, 3], $this->testEvaluateResult(['ratio', 3]));
  }
}
