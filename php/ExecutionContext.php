<?php

namespace JustLand\JustFunc;

class ExecutionContext
{
  /**
   * @var array Contains the error information about the execution.
   */
  private $errors = [];

  /**
   * @var array
   */
  private $handlers;

  public function __construct($handlers)
  {
    $this->handlers = $handlers;
  }

  public function resetErrors()
  {
    $this->errors = [];
  }

  public function addError($errorInfo)
  {
    array_push($this->errors, $errorInfo);
  }

  /**
   * gets errors collected during execution
   * @return array|null
   */
  public function getErrors()
  {
    return count($this->errors) ? $this->errors : null;
  }
  public function execute($code)
  {
    if (!is_array($code)) return self::literal($code);
    if (count($code) === 0) return null;
    $op = array_shift($code);
    if (!isset($this->handlers[$op])) {
      $this->addError(UnknownSymbol::create($op, $code));
      return null;
    }

    $handler = $this->handlers[$op];
    if ($handler) {
      if (is_string($handler)) {
        return call_user_func_array([$handler, 'invoke'], [$this, $code]);
      }
      if (is_array($handler)) {
        return call_user_func_array($handler, [$this, $code]);
      }
      return $handler($this, $code);
    }
  }

  public function unbox($code)
  {
    if (is_array($code)) {
      $type = $code[0];
      $handler = $this->handlers[$type];
      return call_user_func_array([$handler, 'unbox'], [$this, $code]);
    }
    return $code;
  }

  public function handle($op, $subject, $args)
  {
    if (NumberType::is($subject)) return NumberType::handle($this, $op, $subject, $args);
    if (BooleanType::is($subject)) return BooleanType::handle($this, $op, $subject, $args);
  }

  private static function literal($code)
  {
    return $code;
  }
}
