<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class Multiply_Test extends TestCase
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

  public function test_no_arg_returns_1()
  {
    $this->assertSame(1, $this->s->execute(['*']));
  }
  public function test_single_arg_returns_arg()
  {
    $this->assertSame(0, $this->s->execute(['*', 0]));
    $this->assertSame(3, $this->s->execute(['*', 3]));
  }
  public function test_multiple_args()
  {
    $this->assertSame(24, $this->s->execute(['*', 1, 2, 3, 4]));
  }
  public function test_negative_numbers()
  {
    $this->assertSame(-2, $this->s->execute(['*', 1, -2]));
  }
  public function test_not_numeric_gets_null()
  {
    $this->assertSame(null, $this->s->execute(['*', true]));
    $this->assertSame(null, $this->s->execute(['*', '1']));
    $this->assertSame(null, $this->s->execute(['*', null]));
  }
  public function test_nested()
  {
    $this->assertSame(72, $this->s->execute(['*', ['*', 2, 3], ['*', 3, 4]]));
  }
}
