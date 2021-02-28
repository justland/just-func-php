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
      Not::KEY => Not::class,
      Equality::KEY => Equality::class,
      Add::KEY => Add::class,
      Subtract::KEY => Subtract::class,
      Multiply::KEY => Multiply::class,
      Divide::KEY => Divide::class,
      Ratio::KEY => Ratio::class,
      ListFn::KEY => ListFn::class
    ]);
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
    $this->context->resetErrors();
    return [
      $this->context->execute($code),
      $this->context->getErrors()
    ];
  }
}
