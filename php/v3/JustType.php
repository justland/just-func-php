<?php

namespace JustLand\JustFunc\v3;

class JustType
{
  public static function is($type, $value)
  {
    return is_array($value) && count($value) > 0 && $value[0] === $type;
  }

  public static function getType($value)
  {
    // No empty array should reach here.
    return is_array($value) ? $value[0] : gettype($value);
  }

  public static function getSignature($op, $args)
  {
    return self::buildSignature($op, array_map(function ($a) {
      return JustType::getType($a);
    }, $args));
  }

  public static function buildSignature($op, $argTypes)
  {
    $cp = array_slice($argTypes, 0);
    array_unshift($cp, $op);
    return [
      'key' => "(" . implode(' ', $cp) . ")",
      'op' => $op,
      'argTypes' => $argTypes
    ];
  }
}
