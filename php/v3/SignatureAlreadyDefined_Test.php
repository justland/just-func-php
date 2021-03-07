<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class SignatureAlreadyDefined_Test extends TestCase
{
  public function test_message()
  {
    $this->assertEquals([
      'type' => 'SignatureAlreadyDefined',
      'signature' => '(not)',
      'msg' => "(not) already defined"
    ], SignatureAlreadyDefined::create(JustType::buildSignature('not', [])));
  }
}
