<?php

namespace JustLand\JustFunc\v2;

class ListType implements IJustType
{
  const KEY = 'list';

  public function is($value): bool
  {
    return JustType::is(self::KEY, $value);
  }

  public function invoke($context, $op, $code)
  {
    return $code;
  }

  public function unbox($context, $code)
  {
    return array_slice($code, 1);
  }

  public function handle($context, $fn, $args)
  {

  }
}
