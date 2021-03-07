<?php

namespace JustLand\JustFunc\v2;

class ExecutionContext
{
  /**
   * @var array Contains the error information about the execution.
   */
  private $errors = [];

  private $stack;

  /**
   * @var ModuleResolver
   */
  private $resolver;

  /**
   * @param ModuleResolver
   */
  public function __construct($resolver)
  {
    $this->resolver = $resolver;
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
    if (!is_array($code)) return $code;
    if (count($code) === 0) return null;
    $op = array_shift($code);
    $handler = $this->resolver->resolve($op);
    if (!$handler) {
      $this->addError(UnknownSymbol::create($op, $code));
      return null;
    }
    $this->pushStack($op, $code);

    $result = $handler->invoke($this, $op, $code);
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

  public function resolve($fn, $args)
  {
    if (!is_array($fn) && count($args) === 0) return null;
    $params = implode(' ', array_map(function ($a) {
      return $this->resolver->getType($this, $a); /* TODO: nesting */
    }, $args));
    return $this->resolver->resolve("$fn $params");
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
