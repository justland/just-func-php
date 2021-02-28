<?php

namespace JustLand\JustFunc;

class Add
{
  const KEY = '+';
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $i = -1;
    return array_reduce($args, function ($p, $v) use ($context, $i) {
      $i++;
      $v = $context->execute($v);
      if (Number::isNumericOnly($v)) return $p + $v;
      $context->addError(TypeMismatch::create('+', $i, 'number', $v));
    }, 0);
  }
}
