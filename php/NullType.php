<?php

namespace JustLand\JustFunc;

class NullType
{
  public static function is($value) {
    return $value === null;
  }

  public static function handle($context, $op, $subject, $args)
  {
    return null;
  }
}
