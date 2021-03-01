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
    if ($c === 1) {
      if ($first === 0) {
        $context->addError(DivideByZero::create('/', $args));
        return null;
      }
      if (!NumberType::isNumericForm($first)) {
        $context->addError(TypeMismatch::create('/', 0, 'number', $first));
        return null;
      }
      return RatioType::create($context, $args);
    }
    if (!NumberType::isNumericForm($first)) {
      $context->addError(TypeMismatch::create('/', 0, 'number', $first));
      return null;
    }

    $i = 1;
    $denom = array_reduce(array_slice($args, 1), function ($p, $v) use ($context, $i) {
      if ($p === null) return null;
      $v = $context->execute($v);
      if (RatioType::isRatio($v)) return $context->execute(['*', $p, $v]);
      if (NumberType::isNumericOnly($v)) return $p * $v;
      $context->addError(TypeMismatch::create('/', $i++, 'number', $v));
    }, 1);
    if ($denom === 0) {
      $context->addError(DivideByZero::create('/', $args));
      return null;
    }
    return RatioType::create($context, [$first, $denom]);
  }
}
