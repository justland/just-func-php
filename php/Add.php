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
    $i = 0;
    return array_reduce($args, function ($p, $v) use ($context, $i) {
      $v = $context->execute($v);
      if (Ratio::isRatio($p)) {
        if (Ratio::isRatio($v)) {
          return Ratio::create($context, [$p[1] * $v[2] + $v[1] * $p[2], $p[2] * $v[2]]);
        } else {
          return Ratio::create($context, [$p[1] + $v * $p[2], $p[2]]);
        }
      }
      if (Ratio::isRatio($v)) {
        return Ratio::create($context, [$p * $v[2] + $v[1], $v[2]]);
      }
      if (Number::isNumericOnly($v)) return $p + $v;
      $context->addError(TypeMismatch::create('+', $i++, 'number', $v));
    }, 0);
  }
}
