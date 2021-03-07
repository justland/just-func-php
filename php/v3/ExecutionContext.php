<?php

namespace JustLand\JustFunc\v3;

class ExecutionContext
{
  /**
   * @var Analyzer
   */
  private $analyzer;

  private $stack;

  /**
   * @var Resolver
   */
  private $resolver;

  /**
   * @param Analyzer $analyzer
   * @param Resolver $resolver
   */
  public function __construct($analyzer, $resolver)
  {
    $this->analyzer = $analyzer;
    $this->resolver = $resolver;
  }

  public function reset()
  {
    $this->stack = null;
    $this->analyzer->reset();
  }

  public function addError($errorInfo)
  {
    $this->analyzer->addError($errorInfo);
  }

  /**
   * gets errors collected during execution
   * @return array|null
   */
  public function getErrors()
  {
    return $this->analyzer->getErrors();
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
