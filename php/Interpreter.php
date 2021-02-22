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
      'not' => function ($context, $args) {
        return self::not($context, $args);
      },
      '==' => function ($context, $args) {
        return self::equality($context, $args);
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
    $op = array_shift($code);
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
  private static function not($context, $args)
  {
    if (count($args) === 1) {
      $value = $args[0];
      if ($value === true) return false;
      if ($value === false) return true;
    }
    $context->addError([
      'type' => 'InvalidType',
      'op' => 'not',
      'args' => $args,
      'message' => "The 'not' function expects a single boolean value"
    ]);
    return null;
  }

  /**
   * @param ExecutionContext $context
   */
  private static function equality($context, $args)
  {
    $count = count($args);
  }
}
