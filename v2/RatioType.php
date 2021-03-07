<?php

namespace JustLand\JustFunc\v2;

class RatioType implements IJustType
{
  const KEY = 'ratio';

  public function is($value): bool
  {
    return JustType::is(self::KEY, $value);
  }

  /**
   * @param ExecutionContext $context
   * @param array $args
   */
  public function create($context, $args)
  {
    return $this->invoke($context, self::KEY, $args);
  }

  public function invoke($context, $fn, $args)
  {
    $c = count($args);

    if ($c === 0 || $c > 2) {
      $context->addError(ArityMismatch::create('ratio', $args));
      return null;
    }
    if ($c === 1) {
      return $this->invoke($context, $fn, [1, $args[0]]);
    }

    list($numerator, $denominator) = array_map(function ($v) use ($context) {
      return $context->execute($v);
    }, $args);

    if ($numerator === null || $denominator === null) return null;

    if ($this->is($numerator)) {
      return $context->execute(['ratio', $numerator[1], ['*', $numerator[2], $denominator]]);
    }
    if ($this->is($denominator)) {
      return $context->execute(['ratio', ['*', $numerator, $denominator[2]], $denominator[1]]);
    }
    $remainder = $numerator % $denominator;
    if ($remainder === 0) return ($numerator - $remainder) / $denominator;
    return ['ratio', $numerator, $denominator];
  }

  public function unbox($context, $code)
  {
    return $code[1] / $code[2];
  }

  public function handle($context, $fn, $args)
  {

  }
}
