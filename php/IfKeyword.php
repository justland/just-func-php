<?php

namespace JustLand\JustFunc;

class IfKeyword
{
  const KEY = 'if';

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $c = count($args);
    if ($c < 2 || $c > 3) {
      $context->addError(ArityMismatch::create('if', $args));
      return null;
    }

    list($cond, $then) = $args;
    if ($context->execute($cond)) {
      return $context->execute($then);
    }
    if (isset($args[2])) {
      return $context->execute($args[2]);
    }
  }
}
