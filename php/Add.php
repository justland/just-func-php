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
      if (RatioType::is($p)) {
        if (RatioType::is($v)) {
          return RatioType::create($context, [$p[1] * $v[2] + $v[1] * $p[2], $p[2] * $v[2]]);
        } else {
          return RatioType::create($context, [$p[1] + $v * $p[2], $p[2]]);
        }
      }
      if (RatioType::is($v)) {
        return RatioType::create($context, [$p * $v[2] + $v[1], $v[2]]);
      }
      if (NumberType::is($v)) return $p + $v;
      $context->addError(TypeMismatch::create(Add::KEY, $i++, 'number', $v));
    }, 0);
  }
}
