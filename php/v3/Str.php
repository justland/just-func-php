<?php

namespace JustLand\JustFunc\v3;

class Str extends Operator
{
  const KEY = 'str';

  public function handle($context, $op, $rawArgs)
  {
    return array_reduce($rawArgs, function ($p, $a) use ($context) {
      $v = $context->execute($a);
      return "$p$v";
    }, '');
  }
}
