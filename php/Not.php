<?php

namespace JustLand\JustFunc;

class Not
{
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    if (count($args) === 1) {
      $value = $args[0];
      if ($value === true) return false;
      if ($value === false) return true;
    }
    $context->addError([
      'type' => 'InvalidType',
      'op' => 'not',
      'args' => $args,
      'message' => "The 'not' function expects a single boolean value"
    ]);
    return null;
  }
}
