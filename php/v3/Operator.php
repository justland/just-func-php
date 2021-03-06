<?php

namespace JustLand\JustFunc\v3;

abstract class Operator implements IOperator
{
  protected $signatures = [];

  public function addSignatureHandler($signature, $handler)
  {
    $this->signatures[$signature['key']] = [$signature, $handler];
  }

  public function handle($context, $op, $rawArgs)
  {
    $args = array_map([$context, 'execute'], $rawArgs);
    return $this->handleParsedArgs($context, $op, $args);
  }

  public function missingSignature($context, $signature, $op, $args)
  {
    $context->addError(SignatureNotSupported::create($signature, $op, $args));
  }

  protected function handleParsedArgs($context, $op, $args)
  {
    $handler = $this->getSignatureHandler($context, $op, $args);
    return $handler ? $handler($context, $op, $args) : null;
  }

  private function getSignatureHandler($context, $op, $args)
  {
    $signature = JustType::getSignature($op, $args);
    $key = $signature['key'];
    if (isset($this->signatures[$key])) return $this->signatures[$key][1];
    $context->addError(SignatureNotSupported::create($signature, $op, $args));
  }
}
