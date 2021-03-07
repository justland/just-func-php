<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class SignatureNotSupported_Test extends TestCase
{
  public function test_message()
  {
    $op = 'not';
    $args = [];
    $signature = JustType::getSignature($op, $args);
    $this->assertEquals([
      'type' => 'SignatureNotSupported',
      'op' => 'not',
      'args' => [],
      'msg' => "(not) not supported"
    ], SignatureNotSupported::create($signature, $op, $args));
  }
}
