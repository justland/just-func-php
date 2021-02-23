<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class Equality_Test extends TestCase
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
    $this->assertEquals(null, $this->s->execute(['==']));
    $this->assertEquals(
      [[
        'type' => 'Arity',
        'fn' => '==',
        'args' => [],
        'msg' => 'Wrong number of args (0) passed to: =='
      ]],
      $this->s->getErrors()
    );
  }

  public function test_single_literal_arg_always_true()
  {
    $this->assertTrue($this->s->execute(['==', true]));
    $this->assertTrue($this->s->execute(['==', false]));
    $this->assertTrue($this->s->execute(['==', -1]));
    $this->assertTrue($this->s->execute(['==', 0]));
    $this->assertTrue($this->s->execute(['==', 1]));
    $this->assertTrue($this->s->execute(['==', '']));
    $this->assertTrue($this->s->execute(['==', 'a']));
    $this->assertTrue($this->s->execute(['==', null]));
  }

  public function test()
  {
    $this->assertTrue($this->s->execute(['==', 1, 1, 1, 1]));
    $this->assertFalse($this->s->execute(['==', '1', '1', '1', 2]));
  }

  public function skip_test_execute_works_on_boolean()
  {
    $this->assertTrue($this->s->execute(['==', true, true]));
    $this->assertTrue($this->s->execute(['==', false, false]));
    $this->assertFalse($this->s->execute(['==', true, false]));
    $this->assertFalse($this->s->execute(['==', false, true]));
  }

  public function test_execute_with_null_and_literals()
  {
    $this->assertTrue($this->s->execute(['==', null, null]));
    $this->assertFalse($this->s->execute(['==', null, 0]));
    $this->assertFalse($this->s->execute(['==', null, false]));
    $this->assertFalse($this->s->execute(['==', null, '']));
    $this->assertFalse($this->s->execute(['==', 0, null]));
    $this->assertFalse($this->s->execute(['==', false, null]));
    $this->assertFalse($this->s->execute(['==', '', null]));
  }
}
