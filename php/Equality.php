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
      $context->addError(ArityError::create('==', $args));
      return null;
    }

    $value = array_shift($args);
    foreach ($args as $arg) {
      if ($arg !== $value) return false;
    }
    return true;
  }
}
