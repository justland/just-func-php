<?php

namespace JustLand\JustFunc;

class BooleanType
{
  public static function is($value)
  {
    return is_bool($value);
  }
  /**
   * @param ExecutionContext $context
   * @param string $op
   * @param number $subject
   * @param array $args
   */
  public static function handle($context, $op, $subject, $args)
  {
    switch ($op) {
      case Add::KEY:
        $context->addError(TypeMismatch::create('+', $context->argPosition, 'number', $subject));
        return null;
    }
  }
}
