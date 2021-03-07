<?php

namespace JustLand\JustFunc\v3;

class Not implements IModule, IOperator
{
  const KEY = 'not';

  use OperatorTrait;

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

  public function prepareArgs($context, $op, $rawArgs)
  {
    if (count($rawArgs) !== 1) {
      $context->addError(ArityMismatch::create(self::KEY, $rawArgs));
      return null;
    }
    return array_map(function ($arg) use ($context) {
      return $context->execute($arg);
    }, $rawArgs);
  }

  public function missingSignature($context, $signature, $op, $args)
  {
    if ($op === self::KEY && count($args) !== 1)
      $context->addError(ArityMismatch::create(self::KEY, $args));
    else
      $context->addError(SignatureNotSupported::create($signature, $op, $args));
  }

  public function is($value): bool
  {
    return JustType::is(Not::KEY, $value);
  }

  public function handleBoolean($context, $op, $args)
  {
    return !$args[0];
  }
}
