<?php

namespace JustLand\JustFunc\v2;

class ArityMismatch
{
  public static function create($fn, $args) {
    $count = count($args);
    return [
      'type' => 'ArityMismatch',
      'fn' => $fn,
      'args' => $args,
      'msg' => "Wrong number of args ($count) passed to: $fn"
    ];
  }
}
