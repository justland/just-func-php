<?php

namespace JustLand\JustFunc\v3;

class Not_Test extends InterpreterTestCase
{
  public function test_execute_work_with_boolean()
  {
    $this->assertFalse($this->testExecuteResult(['not', true]));
    $this->assertTrue($this->testExecuteResult(['not', false]));
  }

  public function test_execute_with_null_returns_null()
  {
    list($result, $errors) = $this->s->execute(['not', null]);
    $this->assertNull($result);
    $this->assertEquals([SignatureNotSupported::create(
      JustType::getSignature('not', [null]),
      'not',
      [null]
    )], $errors);
  }

  public function test_execute_with_non_boolean_returns_null()
  {
    $codes = [
      ['not', 0],
      ['not', 1],
      ['not', '0'],
      ['not', '1'],
      ['not', 'true'],
      ['not', 'false']
    ];

    foreach ($codes as $code) {
      $op = $code[0];
      $args = array_slice($code, 1);
      $sig = JustType::getSignature($op, $args);
      $this->testExecute(
        null,
        [SignatureNotSupported::create($sig, $op, $args)],
        $code
      );
    }
  }

  public function test_no_args_returns_null_with_arity_mismatch()
  {
    list($result, $errors) = $this->s->execute(['not']);
    $this->assertNull($result);
    $this->assertEquals([ArityMismatch::create('not', [])], $errors);
  }

  public function test_more_than_one_args_returns_null_with_arity_mismatch()
  {
    list($result, $errors) = $this->s->execute(['not', true, false]);
    $this->assertNull($result);
    $this->assertEquals([ArityMismatch::create('not', [true, false])], $errors);
  }

  public function skip_test_execute_with_array_returns_null()
  {
    $this->assertNull($this->testExecuteResult(['not', ['list', true, false]]));
  }

  public function test_nested()
  {
    $this->assertTrue($this->testExecuteResult(['not', ['not', true]]));
  }
}
