<?php

namespace JustLand\JustFunc;

class BooleanType_Test extends InterpreterTestCase
{
  public function test_is_true_for_boolean()
  {
    $this->assertTrue(BooleanType::is(true));
    $this->assertTrue(BooleanType::is(false));
  }
  public function test_is_false_for_non_boolean()
  {
    $this->assertFalse(BooleanType::is(0));
    $this->assertFalse(BooleanType::is(1));
    $this->assertFalse(BooleanType::is(-1));
    $this->assertFalse(BooleanType::is(''));
    $this->assertFalse(BooleanType::is([]));
  }
}
