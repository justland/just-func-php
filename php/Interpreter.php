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
      'not' => Not::class,
      '==' => Equality::class,
      '+' => Add::class,
      '-' => Subtract::class
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
    $c = $this->context = new ExecutionContext();
    $c->resetErrors();

    if (!is_array($code)) return self::literal($code);
    if (count($code) === 0) return null;
    $fn = array_shift($code);
    if (!isset($this->handlers[$fn])) {
      $c->addError(UnknownSymbol::create($fn, $code));
      return null;
    }

    $handler = $this->handlers[$fn];
    if ($handler) {
      if (is_string($handler)) {
        return call_user_func_array([$handler, 'invoke'], [$c, $code]);
      }
      if (is_array($handler)) {
        return call_user_func_array($handler, [$c, $code]);
      }
      return $handler($c, $code);
    }
  }

  private static function literal($code)
  {
    return $code;
  }
}
