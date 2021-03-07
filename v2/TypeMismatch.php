<?php

namespace JustLand\JustFunc\v2;

class TypeMismatch
{
  public static function create($fn, $position, $type, $value)
  {
    $value = is_array($value) ? "[" . implode(", ", $value) . "]" : $value;
    return [
      'type' => 'TypeMismatch',
      'fn' => $fn,
      'position' => $position,
      'type' => $type,
      'value' => $value,
      'msg' => "$fn expects argument $position to be $type, received $value"
    ];
  }
}
