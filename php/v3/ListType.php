<?php

namespace JustLand\JustFunc\v3;

class ListType extends Operator implements IType
{
  const KEY = 'list';

  public function handle($context, $op, $rawArgs)
  {
    return $rawArgs;
  }

  public function unbox($context, $code) {
    return array_slice($code, 1);
  }
}
