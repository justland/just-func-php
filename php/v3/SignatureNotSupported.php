<?php

namespace JustLand\JustFunc\v3;

class SignatureNotSupported
{
  public static function create($signature, $op, $args)
  {
    return [
      'type' => 'SignatureNotSupported',
      'op' => $op,
      'args' => $args,
      'msg' => "{$signature['key']} not supported"
    ];
  }
}
