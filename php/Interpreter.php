<?php

namespace JustLand\JustFunc;

class Interpreter
{
  /**
   * @var ExecutionContext
   */
  private $context;

  public function __construct()
  {
    $this->context = new ExecutionContext([
      'not' => Not::class,
      '==' => Equality::class,
      '+' => Add::class,
      '-' => Subtract::class,
      '*' => Multiply::class,
      // '/' => Divide::class
    ]);
  }

  /**
   * @var array|null Contains the error information about the execution.
   */
  public function getErrors()
  {
    return $this->context->errors;
  }

  /**
   * @param array $code just-func code
   */
  public function execute($code)
  {
    $this->context->resetErrors();

    return $this->context->execute($code);
  }
}
