<?php

namespace JustLand\JustFunc\v3;

class UnknownSymbol
{
  public static function create($op)
  {
    return [
      'type' => 'UnknownSymbol',
      'op' => $op,
      'msg' => "Unable to resolve symbol: $op"
    ];
  }
}
