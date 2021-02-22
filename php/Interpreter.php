<?php

namespace JustLand\JustFunc;

class Interpreter
{
  /**
   * @var ExecutionContext
   */
  private $context;

  /**
   * @var array
   */
  private $handlers;

  public function __construct()
  {
    $this->handlers = [
      'not' => function ($context, $code) {
        return self::not($context, $code);
      }
    ];
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
    $context = $this->context = new ExecutionContext();
    $context->resetErrors();

    if (!is_array($code)) return self::literal($code);
    if (count($code) === 0) return null;

    $op = $code[0];
    $handler = $this->handlers[$op];
    if ($handler) return $handler($context, $code);
  }

  private static function literal($code)
  {
    return $code;
  }

  /**
   * @param ExecutionContext $context
   */
  private static function not($context, $code)
  {
    if (count($code) === 2) {
      $value = $code[1];
      if ($value === true) return false;
      if ($value === false) return true;
    }
    $context->addError([
      'type' => 'InvalidType',
      'op' => $code,
      'message' => "The 'not' function expects a single boolean value"
    ]);
    return null;
  }
}
