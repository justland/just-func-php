<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class UnknownSymbol_Test extends TestCase
{
  public function test_message()
  {
    $this->assertEquals([
      'type' => 'UnknownSymbol',
      'op' => 'not-exist',
      'msg' => "Unable to resolve symbol: not-exist"
    ], UnknownSymbol::create('not-exist'));
  }
}
