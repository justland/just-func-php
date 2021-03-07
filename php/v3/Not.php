<?php

namespace JustLand\JustFunc\v3;

class Not extends Operator implements IModule
{
  const KEY = 'not';

  /**
   * @param Resolver $resolver
   */
  public function register($resolver)
  {
    $resolver->defineOperator(self::KEY, $this);
    $this->addSignatureHandler(
      JustType::buildSignature(self::KEY, ['boolean']),
      [$this, 'handleBoolean']
    );
  }

  public function handle($context, $op, $rawArgs)
  {
    if (count($rawArgs) !== 1) {
      $context->addError(ArityMismatch::create($op, $rawArgs));
      return null;
    }

    return parent::handle($context, $op, $rawArgs);
  }

  public function missingSignature($context, $signature, $op, $args)
  {
    if ($op === self::KEY && count($args) !== 1)
      $context->addError(ArityMismatch::create(self::KEY, $args));
    else
      $context->addError(SignatureNotSupported::create($signature, $op, $args));
  }

  public function handleBoolean($context, $op, $args)
  {
    return !$args[0];
  }
}
