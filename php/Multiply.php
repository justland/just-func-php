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
      if (RatioType::is($p)) {
        if (RatioType::is($v)) {
          return RatioType::create($context, [$p[1] * $v[1], $p[2] * $v[2]]);
        }
        return RatioType::create($context, [$p[1] * $v, $p[2]]);
      }
      if (RatioType::is($v)) {
        return RatioType::create($context, [$p * $v[1], $v[2]]);
      }
      if (NumberType::is($v)) return $p * $v;
    }, 1);
  }
}
