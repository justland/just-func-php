<?php

namespace JustLand\JustFunc\v3;

class IfKeyword extends Operator
{
  const KEY = 'if';

  public function handle($context, $op, $rawArgs)
  {
    $c = count($rawArgs);
    if ($c < 2 || $c > 3) {
      $context->addError(ArityMismatch::create($op, $rawArgs));
      return null;
    }
    list($cond, $then) = $rawArgs;
    if ($context->execute($cond)) {
      return $context->execute($then);
    }
    if (isset($rawArgs[2])) {
      return $context->execute($rawArgs[2]);
    }
  }
}
