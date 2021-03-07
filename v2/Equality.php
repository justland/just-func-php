<?php

namespace JustLand\JustFunc\v2;

class Equality implements IJustFunction
{
  const KEY = '==';

  public function is($value): bool
  {
    return JustType::is(Equality::KEY, $value);
  }

  public function invoke($context, $fn, $args)
  {
    if (count($args) === 0) {
      $context->addError(ArityMismatch::create('==', $args));
      return null;
    }

    $p = $context->execute(array_shift($args));
    foreach ($args as $arg) {
      // Q: should this defer to the handler if present?
      $v = $context->execute($arg);
      list($signature, $handler) = $context->resolve($fn, [$p, $v]);
      if ($handler) return $handler->handle($context, $signature, [$p, $v]);

      return $v === $p;
      // if (RatioType::is($p)) {
      //   if (RatioType::is($v)) {
      //     if ($p[1] * $v[2] !== $v[1] * $p[2]) return false;
      //   } else {
      //     return false;
      //   }
      // } else if (RatioType::is($v)) {
      //   return false;
      // } else {
      //   if ($v !== $p) return false;
      // }
    }
    return true;
  }
}
