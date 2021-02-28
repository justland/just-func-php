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
    list($result, $errors) = $this->s->execute(['/', 0]);
    $this->assertNull($result);
    $this->assertEquals([DivideByZero::create('/', [0])], $errors);
  }

  public function test_single_arg_returns_1_over_value()
  {
    $this->assertEquals(1, $this->testExecuteResult(['/', 1]));
    $this->assertEquals(0.2, $this->testExecuteResult(['/', 5]));
  }

  public function test_two_numbers()
  {
    $this->assertSame(1.5, $this->testExecuteResult(['/', 3, 2]));
  }

  public function test_multiple_numbers()
  {
    $this->assertSame(1, $this->testExecuteResult(['/', 10, 1, 2, 5]));
  }

  public function test_negative_numbers()
  {
    $this->assertSame(-1, $this->testExecuteResult(['/', 1, -1]));
    $this->assertSame(1, $this->testExecuteResult(['/', -1, -1]));
  }

  public function test_not_numeric_returns_null()
  {
    $this->assertNull($this->testExecuteResult(['/', true]));
    $this->assertNull($this->testExecuteResult(['/', '1']));
    $this->assertNull($this->testExecuteResult(['/', null]));
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
  }
}
