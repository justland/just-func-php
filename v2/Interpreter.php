<?php

namespace JustLand\JustFunc\v2;

class Interpreter
{
  /**
   * @var ExecutionContext
   */
  private $context;

  /**
   * @param ModuleResolver $resolver
   */
  public function __construct($resolver)
  {
    $this->context = new ExecutionContext($resolver);
  }

  /**
   * Execute `just-func` code and returns unboxed result.
   * @param array $code just-func code
   * @return array [$result, $errors|null]
   */
  public function execute($code)
  {
    list($result, $errors) = $this->evaluate($code);
    return [
      $this->context->unbox($result),
      $errors
    ];
  }

  /**
   * Evaluates the `just-func` code and returns `just-func` code
   * @param array $code just-func code
   * @return array [$result, $errors|null]
   */
  public function evaluate($code)
  {
    $this->context->reset();
    return [
      $this->context->execute($code),
      $this->context->getErrors()
    ];
  }
}
