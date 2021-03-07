<?php

namespace JustLand\JustFunc\v3;

interface IType extends IOperator
{
  public function unbox($context, $code);
}
