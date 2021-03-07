<?php

namespace JustLand\JustFunc\v3;

class CoreModule implements IModule
{
  /**
   * @param Resolver $resolver
   */
  public function register($resolver)
  {
    $resolver->defineOperator(IfKeyword::KEY, new IfKeyword());
    $resolver->defineOperator(Str::KEY, new Str());
    $resolver->defineType(ListType::KEY, new ListType());
  }
}
