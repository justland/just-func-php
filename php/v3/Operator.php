<?php

namespace JustLand\JustFunc\v3;

abstract class Operator implements IOperator
{
  protected $signatures = [];

  public function addSignatureHandler($signature, $handler)
  {
    $this->signatures[$signature['key']] = [$signature, $handler];
  }
  public function handle($context, $op, $args)
  {
    $signature = JustType::getSignature($op, $args);
    $handler = $this->getSignatureHandler($signature);
    if (!$handler) {
      $context->addError(SignatureNotSupported::create($signature, $op, $args));
      return null;
    }
    return $handler($context, $op, $args);
  }

  private function getSignatureHandler($signature)
  {
    $key = $signature['key'];
    return isset($this->signatures[$key]) ? $this->signatures[$key][1] : null;
  }
}
