<?php

namespace JustLand\JustFunc;

class Number
{
  public static function isNumericOnly($v)
  {
    return !is_string($v) && is_numeric($v);
  }
}
