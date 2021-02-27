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
    $this->assertFalse($this->s->execute(['not', true]));
    $this->assertTrue($this->s->execute(['not', false]));
  }

  public function test_execute_with_null_returns_null()
  {
    $this->assertSame(null, $this->s->execute(['not', null]));

    $this->assertEquals([ArityError::create('not', [null])], $this->s->getErrors());
  }

  public function test_execute_with_non_boolean_returns_null()
  {
    $this->assertSame(null, $this->s->execute(['not', 0]));
    $this->assertSame(null, $this->s->execute(['not', 1]));
    $this->assertSame(null, $this->s->execute(['not', '0']));
    $this->assertSame(null, $this->s->execute(['not', '1']));
    $this->assertSame(null, $this->s->execute(['not', 'true']));
    $this->assertSame(null, $this->s->execute(['not', 'false']));
  }

  public function test_execute_with_no_param_returns_null()
  {
    $this->assertSame(null, $this->s->execute(['not']));
  }

  public function test_execute_with_more_than_one_params_returns_null()
  {
    $this->assertSame(null, $this->s->execute(['not', true, false]));
  }

  public function test_execute_with_array_returns_null()
  {
    $this->assertSame(null, $this->s->execute(['not', [true, false]]));
  }
}
