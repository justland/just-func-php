<?php

namespace JustLand\JustFunc\v3;

/**
 * Core test tests the interpreter without language extension
 */
class Interpreter_Core_Test extends InterpreterTestCase
{
  public function test_execute_success_will_have_errors_to_be_null()
  {
    list(, $errors) = $this->s->execute(null);
    $this->assertNull($errors);
  }

  public function test_execute_null_returns_null()
  {
    $this->assertNull($this->testExecuteResult(null));
  }

  public function test_execute_empty_array_returns_null()
  {
    $this->assertNull($this->testExecuteResult([]));
  }

  public function test_execute_return_literal()
  {
    $this->assertEquals('abc', $this->testExecuteResult('abc'));
    $this->assertEquals(true, $this->testExecuteResult(true));
    $this->assertEquals(1.2, $this->testExecuteResult(1.2));
    $this->assertEquals(1, $this->testExecuteResult(1));
  }
  public function test_execute_not_found_handler_gets_null()
  {
    list($result, $errors) = $this->s->execute(['not-exist']);
    $this->assertNull($result);
    $this->assertEquals([UnknownSymbol::create('not-exist', [])], $errors);
  }
}
