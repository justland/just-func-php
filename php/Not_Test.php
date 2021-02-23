<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class Not_Test extends TestCase
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

  public function test_execute_work_with_boolean()
  {
    $this->assertEquals(false, $this->s->execute(['not', true]));
    $this->assertEquals(true, $this->s->execute(['not', false]));
  }

  public function test_execute_with_null_returns_null()
  {
    $this->assertEquals(null, $this->s->execute(['not', null]));

    $this->assertEquals([[
      "type" => "InvalidType",
      "op" => 'not',
      'args' => [null],
      "message" => "The 'not' function expects a single boolean value"
    ]], $this->s->getErrors());
  }

  public function test_execute_with_non_boolean_returns_null()
  {
    $this->assertEquals(null, $this->s->execute(['not', 0]));
    $this->assertEquals(null, $this->s->execute(['not', 1]));
    $this->assertEquals(null, $this->s->execute(['not', '0']));
    $this->assertEquals(null, $this->s->execute(['not', '1']));
    $this->assertEquals(null, $this->s->execute(['not', 'true']));
    $this->assertEquals(null, $this->s->execute(['not', 'false']));
  }

  public function test_execute_with_no_param_returns_null()
  {
    $this->assertEquals(null, $this->s->execute(['not']));
  }

  public function test_execute_with_more_than_one_params_returns_null()
  {
    $this->assertEquals(null, $this->s->execute(['not', true, false]));
  }

  public function test_execute_with_array_returns_null()
  {
    $this->assertEquals(null, $this->s->execute(['not', [true, false]]));
  }
}
