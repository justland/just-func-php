<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class Add_Test extends TestCase
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

  public function test_no_arg_returns_0()
  {
    $this->assertSame(0, $this->s->execute(['+']));
  }
  public function test_single_arg_returns_arg()
  {
    $this->assertSame(0, $this->s->execute(['+', 0]));
    $this->assertSame(3, $this->s->execute(['+', 3]));
  }
  public function test_multiple_args()
  {
    $this->assertSame(10, $this->s->execute(['+', 1, 2, 3, 4]));
  }
  public function test_negative_numbers()
  {
    $this->assertSame(-1, $this->s->execute(['+', 1, -2]));
  }
}
