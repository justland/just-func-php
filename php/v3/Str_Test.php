<?php

namespace JustLand\JustFunc\v3;

class Str_Test extends InterpreterTestCase
{
  public function test_no_args_gets_empty_string()
  {
    $this->testEvaluate('', null, ['str']);
  }
  public function test()
  {
    $this->testEvaluate('abc', null, ['str', 'a', 'b', 'c']);
  }
  public function test_nested()
  {
    $this->testEvaluate('abcd', null, ['str', 'ab', ['str', 'c', 'd']]);
    $this->testEvaluate('abcd', null, ['str', ['str', 'a', 'b'], 'cd']);
    $this->testEvaluate('abcd', null, ['str', ['str', 'a', 'b'], ['str', 'c', 'd']]);
  }
  public function skip_test_converts_number_to_string()
  {
  }
  public function skip_test_converts_ratio_to_string()
  {
  }
  public function skip_test_converts_boolean_to_string()
  {
  }
  public function skip_test_converts_null_to_string()
  {
  }
  public function skip_test_converts_list_to_string()
  {
  }
  public function skip_test_converts_object_to_string()
  {
  }
}
