<?php

namespace JustLand\JustFunc;

class StringType
{
  const KEY = 'str';

  public static function is($value)
  {
    return is_string($value);
  }

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    return array_reduce($args, function ($p, $a) use ($context) {
      $v = $context->execute($a);
      return "$p$v";
    }, '');
  }

  public static function handle($context, $op, $subject, $args)
  {
    switch ($op) {
      case Add::KEY:
        $context->addError(TypeMismatch::create($op, 0, 'number', $subject));
        return null;
    }
  }
}
