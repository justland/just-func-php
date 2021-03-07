<?php

namespace JustLand\JustFunc\v2;

class JustType
{
  public static function is($type, $value)
  {
    return is_array($value) && count($value) > 0 && $value[0] === $type;
  }
}
