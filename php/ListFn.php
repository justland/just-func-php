<?php

namespace JustLand\JustFunc;

class ListFn
{
  const KEY = 'list';
  public static function invoke($context, $code) {
    return $code;
  }
  public static function unbox($context, $code) {
    return array_slice($code, 1);
  }
}
