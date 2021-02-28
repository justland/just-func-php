<?php

namespace JustLand\JustFunc;

class Number
{
  public static function isNumericOnly($v)
  {
    return !is_string($v) && is_numeric($v);
  }
  /**
   * Check if the value is some kind of numbers.
   */
  public static function isNumericForm($v)
  {
    return self::isNumericOnly($v) || Ratio::isRatio($v);
  }
}
