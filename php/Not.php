<?php

namespace JustLand\JustFunc;

class Not
{
  const KEY = 'not';

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
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
