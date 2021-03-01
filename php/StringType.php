<?php

namespace JustLand\JustFunc;

class StringType
{
  const KEY = 'str';

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    return array_reduce($args, function ($p, $a) use ($context) {
      $v = $context->execute($a);
      return "$p$v";
    }, '');
  }
}
