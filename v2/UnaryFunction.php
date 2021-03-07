<?php

namespace JustLand\JustFunc\v2;

/**
 * Unary function is a function that takes a single argument
 */
class UnaryFunction
{
  /**
   * Types that supported by this unary function.
   * @param array
   */
  protected $types = [];

  public function register($type) {
    $this->types[] = $type;
  }
}
