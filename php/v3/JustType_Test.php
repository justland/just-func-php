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

  public function test_getSignature_integer_arg()
  {
    $this->testGetSignature([
      'key' => '(+ integer)',
      'op' => '+',
      'argTypes' => ['integer']
    ], '+', [1]);
  }

  public function test_getSignature_number_arg()
  {
    $this->testGetSignature([
      'key' => '(+ number)',
      'op' => '+',
      'argTypes' => ['number']
    ], '+', [1.1]);
  }

  public function test_getSignature_boolean_arg()
  {
    $this->testGetSignature([
      'key' => '(+ boolean boolean)',
      'op' => '+',
      'argTypes' => ['boolean', 'boolean']
    ], '+', [true, false]);
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
