<?php

namespace JustLand\JustFunc;

class Equality
{
  const KEY = '==';
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

    $p = $context->execute(array_shift($args));
    foreach ($args as $arg) {
      $v = $context->execute($arg);
      if (RatioType::is($p)) {
        if (RatioType::is($v)) {
          if ($p[1] * $v[2] !== $v[1] * $p[2]) return false;
        } else {
          return false;
        }
      } else if (RatioType::is($v)) {
        return false;
      } else {
        if ($v !== $p) return false;
      }
    }
    return true;
  }
}
