<?php

namespace JustLand\JustFunc;

class ExecutionContext
{
  /**
   * @var array|null Contains the error information about the execution.
   */
  public $errors;

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
    $this->errors = null;
  }

  public function addError($errorInfo)
  {
    if (!$this->errors) $this->errors = [];
    array_push($this->errors, $errorInfo);
  }
  public function execute($code)
  {
    if (!is_array($code)) return self::literal($code);
    if (count($code) === 0) return null;
    $fn = array_shift($code);
    if (!isset($this->handlers[$fn])) {
      $this->addError(UnknownSymbol::create($fn, $code));
      return null;
    }

    $handler = $this->handlers[$fn];
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

  private static function literal($code)
  {
    return $code;
  }
}
