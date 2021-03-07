<?php

namespace JustLand\JustFunc\v3;

interface IModule
{
  /**
   * @param Resolver $resolver
   */
  public function register($resolver);
}
