<?php

namespace JustLand\JustFunc\v2;

interface IJustType extends IJustFunction
{
  public function unbox($context, $code);

  public function handle($context, $fn, $args);
}
