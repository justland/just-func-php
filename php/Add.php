<?php

namespace JustLand\JustFunc;

class Add
{
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    return array_reduce($args, function ($p, $v) {
      if (is_string($v)) return null;
      if (!is_numeric($v)) return null;
      return $p + $v;
    }, 0);
  }
}
