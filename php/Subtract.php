<?php

namespace JustLand\JustFunc;

class Subtract
{
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $c = count($args);
    if ($c === 0) {
      $context->addError(ArityError::create('-', $args));
      return null;
    }
    $first = array_shift($args);
    if (!Number::isNumericOnly($first)) return null;

    if ($c === 1) {
      return -$first;
    }

    return array_reduce($args, function ($p, $v) {
      if (Number::isNumericOnly($v)) return $p - $v;
    }, $first);
  }
}
