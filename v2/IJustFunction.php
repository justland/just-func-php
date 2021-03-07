<?php

namespace JustLand\JustFunc\v2;

interface IJustFunction
{
  public function is($value): bool;

  /**
   * @param ExecutionContext $context
   * @param string $fn
   * @param array $args
   */
  public function invoke($context, $fn, $args);
}
