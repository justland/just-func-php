<?php

namespace JustLand\JustFunc;

class Mod
{
  const KEY = 'mod';
  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public static function invoke($context, $args)
  {
    $c = count($args);
    if ($c !== 2) {
      $context->addError(ArityMismatch::create('mod', $args));
      return null;
    }
    $numerator = $context->execute($args[0]);
    $denominator = $context->execute($args[1]);
    if ($denominator === 0) {
      $context->addError(DivideByZero::create('mod', $args));
      return null;
    }
    if (!NumberType::isNumericForm($numerator)) {
      $context->addError(TypeMismatch::create('mod', 0, 'number', $numerator));
      return null;
    }
    if (!NumberType::isNumericForm($denominator)) {
      $context->addError(TypeMismatch::create('mod', 1, 'number', $denominator));
      return null;
    }
    if (RatioType::isRatio($numerator)) {
      if (RatioType::isRatio($denominator)) {
        return RatioType::create($context, [
          ($numerator[1] * $denominator[2]) % ($denominator[1] * $numerator[2]),
          $numerator[2] * $denominator[2]
        ]);
      }
      return RatioType::create($context, [$numerator[1] - $denominator * $numerator[2], $numerator[2]]);
    }
    if (RatioType::isRatio($denominator)) {
      return RatioType::create($context, [$numerator * $denominator[2] % $denominator[1], $denominator[2]]);
    }
    return $numerator % $denominator;
  }
}
