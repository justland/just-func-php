<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class Interpreter_equal_Test extends TestCase
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

  public function skip_test_execute_works_on_literals()
  {
    $this->assertEquals(true, $this->s->execute(['==', true, true]));
    $this->assertEquals(true, $this->s->execute(['==', false, false]));
    $this->assertEquals(false, $this->s->execute(['==', true, false]));
    $this->assertEquals(false, $this->s->execute(['==', false, true]));
  }

  public function skip_test_execute_with_null_and_literals()
  {
    $this->assertEquals(true, $this->s->execute(['==', null, null]));
    $this->assertEquals(false, $this->s->execute(['==', null, 0]));
    $this->assertEquals(false, $this->s->execute(['==', null, false]));
    $this->assertEquals(false, $this->s->execute(['==', null, '']));
    $this->assertEquals(false, $this->s->execute(['==', 0, null]));
    $this->assertEquals(false, $this->s->execute(['==', false, null]));
    $this->assertEquals(false, $this->s->execute(['==', '', null]));
  }

  // public function test_execute_with_non_boolean_returns_null()
  // {
  //   $this->assertEquals(null, $this->s->execute(['not', 0]));
  //   $this->assertEquals(null, $this->s->execute(['not', 1]));
  //   $this->assertEquals(null, $this->s->execute(['not', '0']));
  //   $this->assertEquals(null, $this->s->execute(['not', '1']));
  //   $this->assertEquals(null, $this->s->execute(['not', 'true']));
  //   $this->assertEquals(null, $this->s->execute(['not', 'false']));
  // }

  // public function test_execute_with_no_param_returns_null()
  // {
  //   $this->assertEquals(null, $this->s->execute(['not']));
  // }

  // public function test_execute_with_more_than_one_params_returns_null()
  // {
  //   $this->assertEquals(null, $this->s->execute(['not', true, false]));
  // }

  // public function test_execute_with_array_returns_null()
  // {
  //   $this->assertEquals(null, $this->s->execute(['not', [true, false]]));
  // }
}
