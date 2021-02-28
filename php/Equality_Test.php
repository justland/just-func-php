<?php

namespace JustLand\JustFunc;

class Equality_Test extends InterpreterTestCase
{
  public function test_requires_at_least_one_arg()
  {
    list($result, $errors) = $this->s->execute(['==']);
    $this->assertNull($result);
    $this->assertEquals([ArityMismatch::create('==', [])], $errors);
  }

  public function test_single_literal_arg_always_true()
  {
    $this->assertTrue($this->testExecuteResult(['==', true]));
    $this->assertTrue($this->testExecuteResult(['==', false]));
    $this->assertTrue($this->testExecuteResult(['==', -1]));
    $this->assertTrue($this->testExecuteResult(['==', 0]));
    $this->assertTrue($this->testExecuteResult(['==', 1]));
    $this->assertTrue($this->testExecuteResult(['==', '']));
    $this->assertTrue($this->testExecuteResult(['==', 'a']));
    $this->assertTrue($this->testExecuteResult(['==', null]));
  }

  public function test()
  {
    $this->assertTrue($this->testExecuteResult(['==', 1, 1]));
    $this->assertTrue($this->testExecuteResult(['==', true, true]));
    $this->assertFalse($this->testExecuteResult(['==', '1', 1]));
  }
  public function test_supports_variadic_arguments()
  {
    $this->assertTrue($this->testExecuteResult(['==', 1, 1, 1, 1]));
    $this->assertFalse($this->testExecuteResult(['==', 1, 1, 1, 2]));
  }
  public function test_nested()
  {
    $this->assertTrue($this->testExecuteResult([
      '==',
      ['==', 1, 1],
      ['==', 'a', 'a'],
      true
    ]));
  }
}
