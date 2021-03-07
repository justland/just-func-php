<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class JustType_Test extends TestCase
{
  public function test_buildSignature_empty_args()
  {
    $this->testBuildSignature([
      'key' => '(not)',
      'op' => 'not',
      'argTypes' => []
    ], 'not', []);
  }

  public function test_buildSignature_unary()
  {
    $this->testBuildSignature([
      'key' => '(+ number)',
      'op' => '+',
      'argTypes' => ['number']
    ], '+', ['number']);
  }

  public function test_getSignature_empty_args()
  {
    $this->testGetSignature([
      'key' => '(not)',
      'op' => 'not',
      'argTypes' => []
    ], 'not', []);
  }

  private function testGetSignature($expected, $op, $args)
  {
    $this->assertEquals($expected, JustType::getSignature($op, $args));
  }

  private function testBuildSignature($expected, $op, $argTypes)
  {
    $this->assertEquals($expected, JustType::buildSignature($op, $argTypes));
  }
}
