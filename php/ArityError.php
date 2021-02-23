<?php

namespace JustLand\JustFunc;

class ArityError
{
  public static function create($fn, $args) {
    $count = count($args);
    return [
      'type' => 'Arity',
      'fn' => $fn,
      'args' => $args,
      'msg' => "Wrong number of args ($count) passed to: $fn"
    ];
  }
}
