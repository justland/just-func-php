<?php

namespace JustLand\JustFunc\v3;

class ArityMismatch
{
  public static function create($op, $args) {
    $count = count($args);
    return [
      'type' => 'ArityMismatch',
      'op' => $op,
      'args' => $args,
      'msg' => "Wrong number of args ($count) passed to: $op"
    ];
  }
}
