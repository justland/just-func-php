<?php

namespace JustLand\JustFunc;

class Subtract
{
  const KEY = '-';
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $c = count($args);
    if ($c === 0) {
      $context->addError(ArityMismatch::create('-', $args));
      return null;
    }
    $first = $context->execute(array_shift($args));
    if (!NumberType::isNumericForm($first)) return null;

    if ($c === 1) {
      if (RatioType::isRatio($first)) {
        $first[1] = -$first[1];
        return $first;
      }
      return -$first;
    }

    return array_reduce($args, function ($p, $v) use ($context) {
      $v = $context->execute($v);
      if (RatioType::isRatio($p)) {
        if (RatioType::isRatio($v)) {
          return RatioType::create($context, [$p[1] * $v[2] - $v[1] * $p[2], $p[2] * $v[2]]);
        } else {
          return RatioType::create($context, [$p[1] - $v * $p[2], $p[2]]);
        }
      }
      if (RatioType::isRatio($v)) {
        return RatioType::create($context, [$p * $v[2] - $v[1], $v[2]]);
      }
      if (NumberType::is($v)) return $p - $v;
    }, $first);
  }
}
