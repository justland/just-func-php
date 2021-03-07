<?php

namespace JustLand\JustFunc\v3;

class ExecutionContext
{
  /**
   * @var array Contains the error information about the execution.
   */
  private $errors = [];

  private $stack;

  /**
   * @var Resolver
   */
  private $resolver;

  /**
   * @param Resolver
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
    $opHandler = $this->resolver->getOperatorHandler($op);
    if (!$opHandler) {
      $this->addError(UnknownSymbol::create($op));
      return null;
    }

    $args = $opHandler->prepareArgs($this, $op, $code);
    if (!$args) return null;

    $signature = JustType::getSignature($op, $args);
    $handler = $opHandler->getSignatureHandler($signature['key']);
    if (!$handler) {
      $opHandler->missingSignature($this, $signature, $op, $args);
      return null;
    }

    try {
      $this->pushStack($op, $args);
      return $handler($this, $op, $args);
    } finally {
      $this->popStack();
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
