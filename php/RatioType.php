<?php

namespace JustLand\JustFunc;

class RatioType
{
  const KEY = 'ratio';
  public static function isRatio($value)
  {
    return is_array($value) && count($value) > 0 && $value[0] === 'ratio';
  }

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function create($context, $args)
  {
    return self::invoke($context, $args);
  }

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $c = count($args);

    if ($c === 0 || $c > 2) {
      $context->addError(ArityMismatch::create('ratio', $args));
      return null;
    }
    if ($c === 1) {
      return self::invoke($context, [1, $args[0]]);
    }

    list($numerator, $denominator) = array_map(function ($v) use ($context) {
      return $context->execute($v);
    }, $args);

    if ($numerator === null || $denominator === null) return null;

    if (self::isRatio($numerator)) {
      return $context->execute(['ratio', $numerator[1], ['*', $numerator[2], $denominator]]);
    }
    if (self::isRatio($denominator)) {
      return $context->execute(['ratio', ['*', $numerator, $denominator[2]], $denominator[1]]);
    }
    $remainder = $numerator % $denominator;
    if ($remainder === 0) return ($numerator - $remainder) / $denominator;
    return ['ratio', $numerator, $denominator];
  }

  public static function unbox($context, $code)
  {
    return $code[1] / $code[2];
  }
}
