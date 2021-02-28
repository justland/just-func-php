<?php

namespace JustLand\JustFunc;

class Add_Test extends InterpreterTestCase
{
  public function test_no_arg_returns_0()
  {
    $this->testExecute(0, null, ['+']);
  }
  public function test_single_arg_returns_arg()
  {
    $this->testExecute(0, null, ['+', 0]);
    $this->testExecute(3, null, ['+', 3]);
  }
  public function test_multiple_args()
  {
    $this->testExecute(10, null, ['+', 1, 2, 3, 4]);
  }
  public function test_negative_numbers()
  {
    $this->testExecute(-1, null, ['+', 1, -2]);
  }
  public function test_not_numeric_gets_null()
  {
    $this->testExecute(
      null,
      [TypeMismatch::create('+', 0, 'number', true)],
      ['+', true]
    );
    $this->testExecute(
      null,
      [TypeMismatch::create('+', 0, 'number', '1')],
      ['+', '1']
    );
    $this->testExecute(
      null,
      [TypeMismatch::create('+', 0, 'number', null)],
      ['+', null]
    );
    $this->testExecute(
      null,
      [TypeMismatch::create('+', 0, 'number', [1, 2])],
      ['+', ['list', 1, 2]]
    );
  }
  public function test_nested()
  {
    $this->testExecute(6, null, ['+', ['+', 1, 2], ['+', 1, 2]]);
  }
}
