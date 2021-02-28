<?php

namespace JustLand\JustFunc;

class Multiply_Test extends InterpreterTestCase
{
  public function test_no_arg_returns_1()
  {
    $this->assertSame(1, $this->testExecuteResult(['*']));
  }
  public function test_single_arg_returns_arg()
  {
    $this->assertSame(0, $this->testExecuteResult(['*', 0]));
    $this->assertSame(3, $this->testExecuteResult(['*', 3]));
  }
  public function test_multiple_args()
  {
    $this->assertSame(24, $this->testExecuteResult(['*', 1, 2, 3, 4]));
  }
  public function test_negative_numbers()
  {
    $this->assertSame(-2, $this->testExecuteResult(['*', 1, -2]));
  }
  public function test_not_numeric_gets_null()
  {
    $this->assertNull($this->testExecuteResult(['*', true]));
    $this->assertNull($this->testExecuteResult(['*', '1']));
    $this->assertNull($this->testExecuteResult(['*', null]));
  }
  public function test_nested()
  {
    $this->assertSame(72, $this->testExecuteResult(['*', ['*', 2, 3], ['*', 3, 4]]));
  }
}
