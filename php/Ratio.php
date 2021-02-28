<?php

namespace JustLand\JustFunc;

class Ratio
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
    list($numerator, $denominator) = array_map(function($v) use ($context) {
      return $context->execute($v);
    }, $args);

    if(Ratio::isRatio($numerator)) {

    }

    return ['ratio', $numerator, $denominator];
  }

  public static function op($context, $op, $args)
  {
  }

  public static function unbox($context, $args)
  {
    return $args[0] / $args[1];
  }
}
