<?php

namespace JustLand\JustFunc\v2;

class Not implements IJustFunction
{
  const KEY = 'not';

  public function is($value): bool
  {
    return JustType::is(Not::KEY, $value);
  }

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public function invoke($context, $fn, $args)
  {
    if (count($args) === 1) {
      $value = $context->execute($args[0]);
      if ($value === true) return false;
      if ($value === false) return true;
    }
    $context->addError(ArityMismatch::create('not', $args));
    return null;
  }
}
