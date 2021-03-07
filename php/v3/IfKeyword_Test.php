<?php

namespace JustLand\JustFunc\v3;

class IfKeyword_Test extends InterpreterTestCase
{
  public function test_no_or_one_args_gets_arity_mismatch()
  {
    $this->testEvaluate(null, [ArityMismatch::create('if', [])], ['if']);
    $this->testEvaluate(null, [ArityMismatch::create('if', ['cond'])], ['if', 'cond']);
  }
  public function test_more_than_3_args_gets_arity_mismatch()
  {
    $this->testEvaluate(
      null,
      [ArityMismatch::create('if', ['cond', 'then', 'else', 'invalid'])],
      ['if', 'cond', 'then', 'else', 'invalid']
    );
  }
  public function test_return_then_if_cond_is_true()
  {
    $this->testEvaluate('then', null, ['if', true, 'then']);
  }
  public function test_return_then_if_cond_is_truthy()
  {
    $this->testEvaluate('then', null, ['if', 1, 'then']);
    $this->testEvaluate('then', null, ['if', -1.0, 'then']);
    $this->testEvaluate('then', null, ['if', 'a', 'then']);
    // $this->testEvaluate('then', null, ['if', ['+', 0, 1], ['str', 'then']]);
    $this->testEvaluate('then', null, ['if', ['list', 1], ['str', 'then']]);
  }
  public function test_return_null_if_cond_is_falsy()
  {
    $this->testEvaluate(null, null, ['if', false, 'then']);
  }
  public function test_return_else_if_cond_is_falsy()
  {
    $this->testEvaluate('else', null, ['if', false, 'then', 'else']);
    $this->testEvaluate('else', null, ['if', 0, 'then', 'else']);
    $this->testEvaluate('else', null, ['if', '', 'then', 'else']);
    // $this->testEvaluate('else', null, ['if', ['+', 0, 0], 'then', 'else']);
    $this->testEvaluate('else', null, ['if', false, 'then', ['str', 'else']]);
  }
}
