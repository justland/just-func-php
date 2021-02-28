<?php

namespace JustLand\JustFunc;

class DivideByZero
{
  public static function create($fn, $args) {
    $count = count($args);
    return [
      'type' => 'DivideByZero',
      'fn' => $fn,
      'args' => $args,
      'msg' => "Divide by zero"
    ];
  }
}
