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
    if (count($args) === 0) {
      return 0;
    }

    return array_reduce($args, function ($p, $v) {
      return $p + $v;
    }, 0);
  }
}
