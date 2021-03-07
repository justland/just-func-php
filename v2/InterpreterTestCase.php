<?php

namespace JustLand\JustFunc\v2;

use PHPUnit\Framework\TestCase;

class InterpreterTestCase extends TestCase
{
  /**
   * @var Interpreter
   */
  protected $s;

  protected function setUp(): void
  {
    parent::setUp();
    $this->s = new Interpreter(new ModuleResolver());
  }

  protected function testExecute($expectedResult, $expectedErrors, $code)
  {
    list($result, $errors) = $this->s->execute($code);
    if (is_array($expectedResult)) {
      $this->assertEquals($expectedResult, $result);
    } else {
      $this->assertSame($expectedResult, $result);
    }
    $this->assertEquals($expectedErrors, $errors);
  }

  /**
   * Test execute and gets the result.
   * Use this when not expecting errors.
   */
  protected function testExecuteResult($code)
  {
    list($result, $errors) = $this->s->execute($code);
    if ($errors) $this->failWithErrors($errors);
    return $result;
  }

  protected function testEvaluate($expectedResult, $expectedErrors, $code)
  {
    list($result, $errors) = $this->s->evaluate($code);
    if (is_array($expectedResult)) {
      $this->assertEquals($expectedResult, $result);
    } else {
      $this->assertSame($expectedResult, $result);
    }
    $this->assertEquals($expectedErrors, $errors);
  }

  protected function testEvaluateResult($code)
  {
    list($result, $errors) = $this->s->evaluate($code);
    if ($errors) $this->failWithErrors($errors);
    return $result;
  }

  protected function failWithErrors($errors)
  {
    $messages = array_map(function ($e) {
      return $e['msg'];
    }, $errors);
    array_unshift($messages, "There are errors:");
    $this->fail(implode("\n", $messages));
  }
}
