<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class Subtract_Test extends TestCase
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

  public function test_requires_at_least_one_arg()
  {
    $this->assertSame(null, $this->s->execute(['-']));
    $this->assertEquals(
      [ArityMismatch::create('-', [])],
      $this->s->getErrors()
    );
  }

  public function test_single_arg_returns_negative_arg()
  {
    $this->assertSame(0, $this->s->execute(['-', 0]));
    $this->assertSame(-3, $this->s->execute(['-', 3]));
  }

  public function test_subtract_two_numbers()
  {
    $this->assertSame(1, $this->s->execute(['-', 3, 2]));
  }

  public function test_multiple_numbers()
  {
    $this->assertSame(0, $this->s->execute(['-', 10, 1, 2, 3, 4]));
  }

  public function test_negative_numbers()
  {
    $this->assertSame(2, $this->s->execute(['-', 1, -1]));
    $this->assertSame(0, $this->s->execute(['-', -1, -1]));
  }

  public function test_not_numeric_returns_null()
  {
    $this->assertSame(null, $this->s->execute(['-', true]));
    $this->assertSame(null, $this->s->execute(['-', '1']));
    $this->assertSame(null, $this->s->execute(['-', null]));
  }
  public function test_nested()
  {
    $this->assertSame(3, $this->s->execute(['-', ['-', 10, 2], ['-', 10, 5]]));
  }
}
