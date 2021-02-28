<?php

namespace JustLand\JustFunc;

class Multiply
{
  const KEY = '*';
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    return array_reduce($args, function ($p, $v) use ($context) {
      $v = $context->execute($v);
      if (Number::isNumericOnly($v)) return $p * $v;
    }, 1);
  }
}
