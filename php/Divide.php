<?php

namespace JustLand\JustFunc;

class Divide
{
  const KEY = '/';
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $c = count($args);
    if ($c === 0) {
      $context->addError(ArityMismatch::create('/', $args));
      return null;
    }
    $first = $context->execute($args[0]);
    if ($first === 0) {
      $context->addError(DivideByZero::create('/', $args));
      return null;
    }
    if (!Number::isNumericForm($first)) return null;

    if ($c === 1) {
      return Ratio::create($context, $args);
    }

    array_shift($args);
    $second = $context->execute(array_shift($args));
    return Ratio::create($context, [
      $first,
      array_reduce($args, function ($p, $v) use ($context) {
        $v = $context->execute($v);
        if (Number::isNumericOnly($v)) return $p * $v;
      }, $second)
    ]);
  }
}
