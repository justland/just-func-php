<?php

namespace JustLand\JustFunc\v2;

class UnknownSymbol
{
  public static function create($fn, $args)
  {
    return [
      'type' => 'UnknownSymbol',
      'fn' => $fn,
      'args' => $args,
      'msg' => "Unable to resolve symbol $fn"
    ];
  }
}
