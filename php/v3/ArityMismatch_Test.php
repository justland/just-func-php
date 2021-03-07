<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class ArityMismatch_Test extends TestCase
{
  public function test_message()
  {
    $this->assertEquals([
      'type' => 'ArityMismatch',
      'op' => '-',
      'args' => [],
      'msg' => 'Wrong number of args (0) passed to: -'
    ], ArityMismatch::create('-', []));
  }
}
