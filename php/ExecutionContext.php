<?php

namespace JustLand\JustFunc;

class ExecutionContext
{
  /**
   * @var array Contains the error information about the execution.
   */
  private $errors = [];

  private $stack;

  /**
   * @var array
   */
  private $handlers;

  public function __construct($handlers)
  {
    $this->handlers = $handlers;
  }

  public function reset()
  {
    $this->stack = null;
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
    $this->pushStack($op, $code);

    $handler = $this->handlers[$op];
    if (is_string($handler)) {
      $result = call_user_func_array([$handler, 'invoke'], [$this, $code]);
    } else if (is_array($handler)) {
      $result = call_user_func_array($handler, [$this, $code]);
    } else {
      $result = $handler($this, $code);
    }
    $this->popStack();
    return $result;
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

  // public function handle($op, $subject, $args)
  // {
  //   if (NumberType::is($subject)) return NumberType::handle($this, $op, $subject, $args);
  //   if (BooleanType::is($subject)) return BooleanType::handle($this, $op, $subject, $args);
  //   if (StringType::is($subject)) return StringType::handle($this, $op, $subject, $args);
  //   if (NullType::is($subject)) return NullType::handle($this, $op, $subject, $args);
  // }

  private static function literal($code)
  {
    return $code;
  }

  private function pushStack($op, $args)
  {
    $this->stack = [
      'parent' => $this->stack,
      'store' => [],
      'op' => $op,
      'args' => $args
    ];
  }
  private function popStack()
  {
    $this->stack = $this->stack['parent'];
  }
}
