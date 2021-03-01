<?php

namespace JustLand\JustFunc;

class NumberType
{
  public static function is($v)
  {
    return !is_string($v) && is_numeric($v);
  }
  /**
   * Check if the value is some kind of numbers.
   */
  public static function isNumericForm($v)
  {
    return self::is($v) || RatioType::isRatio($v);
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
        return self::handleAdd($context, $op, $subject, $args);
    }
  }

  /**
   * @param ExecutionContext $context
   * @param string $op
   * @param int $subject
   * @param array $args
   */
  private static function handleAdd($context, $op, $subject, $args)
  {
    $c = count($args);
    if ($c === 0) return $subject;
    $next = array_shift($args);
    echo "next: $next";
    return $context->handle($op, $subject + $next, $args);
  }
}
