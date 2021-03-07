<?php

namespace JustLand\JustFunc\v3;

class SignatureAlreadyDefined
{
  public static function create($signature)
  {
    $key = $signature['key'];
    return [
      'type' => 'SignatureAlreadyDefined',
      'signature' => $key,
      'msg' => "$key already defined"
    ];
  }
}
