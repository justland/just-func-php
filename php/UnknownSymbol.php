<?php

namespace JustLand\JustFunc;

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
