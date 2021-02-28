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
    if (!Number::isNumericForm($first)) return null;

    if ($c === 1) {
      if (Ratio::isRatio($first)) {
        $first[1] = -$first[1];
        return $first;
      }
      return -$first;
    }

    return array_reduce($args, function ($p, $v) use ($context) {
      $v = $context->execute($v);
      if (Ratio::isRatio($p)) {
        if (Ratio::isRatio($v)) {
          return Ratio::create($context, [$p[1] * $v[2] - $v[1] * $p[2], $p[2] * $v[2]]);
        } else {
          return Ratio::create($context, [$p[1] - $v * $p[2], $p[2]]);
        }
      }
      if (Ratio::isRatio($v)) {
        return Ratio::create($context, [$p * $v[2] - $v[1], $v[2]]);
      }
      if (Number::isNumericOnly($v)) return $p - $v;
    }, $first);
  }
}
