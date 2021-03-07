<?php

namespace JustLand\JustFunc\v3;

interface IType
{
  public function unbox($context, $code);

  public function handle($context, $fn, $args);
}
