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
      if (Number::isNumericOnly($v)) return $p + $v;
    }, 0);
  }
}
