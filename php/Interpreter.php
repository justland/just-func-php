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
      'not' => [Not::class, 'invoke'],
      '==' => [Equality::class, 'invoke']
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
    if ($handler) {
      if (is_array($handler)) {
        return call_user_func_array($handler, [$context, $code]);
      }
      return $handler($context, $code);
    }
  }

  private static function literal($code)
  {
    return $code;
  }
}
