<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

/**
 * Core test tests the interpreter without language extension
 */
class Interpreter_Core_Test extends TestCase
{
  /**
   * @var Interpreter
   */
  private $s;

  protected function setUp(): void
  {
    parent::setUp();
    $this->s = new Interpreter();
  }

  public function test_execute_success_will_have_errors_to_be_null()
  {
    $this->s->execute(null);
    $this->assertNull($this->s->getErrors());
  }

  public function test_execute_null_returns_null()
  {
    $this->assertEquals(null, $this->s->execute(null));
  }

  public function test_execute_empty_array_returns_null()
  {
    $this->assertEquals(null, $this->s->execute([]));
  }

  public function test_execute_return_literal()
  {
    $this->assertEquals('abc', $this->s->execute('abc'));
    $this->assertEquals(true, $this->s->execute(true));
    $this->assertEquals(1.2, $this->s->execute(1.2));
    $this->assertEquals(1, $this->s->execute(1));
  }
}
