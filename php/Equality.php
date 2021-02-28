<?php

namespace JustLand\JustFunc;

class Equality
{
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    if (count($args) === 0) {
      $context->addError(ArityMismatch::create('==', $args));
      return null;
    }

    $value = $context->execute(array_shift($args));
    foreach ($args as $arg) {
      if ($context->execute($arg) !== $value) return false;
    }
    return true;
  }
}
