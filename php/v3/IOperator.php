<?php

namespace JustLand\JustFunc\v3;

interface IOperator
{
  /**
   * @param string $signature
   * @param callable|array $handler
   */
  public function addSignatureHandler($signature, $handler);

  /**
   * Handles the call.
   * @param ExecutionContext $context
   * @param string $op
   * @param array $rawArgs
   * @return array|null returns null if the `$rawArgs` is not valid.
   */
  public function handle($context, $op, $rawArgs);

  /**
   * Populate corresponding error when there is no handler for the particular function signature.
   * This function is delegated to the operator so that it can provide better error message with context.
   * @param ExecutionContext $context
   * @param array $signature [key=>string, op=>string, argTypes=>string[]]
   * @param string $op
   * @param array $args
   */
  public function missingSignature($context, $signature, $op, $args);
}
