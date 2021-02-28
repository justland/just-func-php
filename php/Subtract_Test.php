<?php

namespace JustLand\JustFunc;

class Subtract_Test extends InterpreterTestCase
{
  public function test_requires_at_least_one_arg()
  {
    list($result, $errors) = $this->s->execute(['-']);
    $this->assertNull($result);
    $this->assertEquals([ArityMismatch::create('-', [])], $errors);
  }

  public function test_single_arg_returns_negative_arg()
  {
    $this->assertSame(0, $this->testExecuteResult(['-', 0]));
    $this->assertSame(-3, $this->testExecuteResult(['-', 3]));
  }

  public function test_subtract_two_numbers()
  {
    $this->assertSame(1, $this->testExecuteResult(['-', 3, 2]));
  }

  public function test_multiple_numbers()
  {
    $this->assertSame(0, $this->testExecuteResult(['-', 10, 1, 2, 3, 4]));
  }

  public function test_negative_numbers()
  {
    $this->assertSame(2, $this->testExecuteResult(['-', 1, -1]));
    $this->assertSame(0, $this->testExecuteResult(['-', -1, -1]));
  }

  public function test_not_numeric_returns_null()
  {
    $this->assertNull($this->testExecuteResult(['-', true]));
    $this->assertNull($this->testExecuteResult(['-', '1']));
    $this->assertNull($this->testExecuteResult(['-', null]));
  }
  public function test_nested()
  {
    $this->assertSame(3, $this->testExecuteResult(['-', ['-', 10, 2], ['-', 10, 5]]));
  }
}
