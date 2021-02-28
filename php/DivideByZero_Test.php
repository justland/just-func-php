<?php

namespace JustLand\JustFunc;

use PHPUnit\Framework\TestCase;

class DivideByZero_Test extends TestCase
{
  public function test_message()
  {
    $this->assertEquals([
      'type' => 'DivideByZero',
      'fn' => '/',
      'args' => [0],
      'msg' => 'Divide by zero'
    ], DivideByZero::create('/', [0]));
  }
}
