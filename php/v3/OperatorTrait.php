<?php

namespace JustLand\JustFunc\v3;

trait OperatorTrait
{
  protected $signatures = [];

  public function addSignatureHandler($signature, $handler)
  {
    $this->signatures[$signature['key']] = [$signature, $handler];
  }

  public function getSignatureHandler($signature)
  {
    return isset($this->signatures[$signature]) ? $this->signatures[$signature][1] : null;
  }
}
