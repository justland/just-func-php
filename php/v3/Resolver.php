<?php

namespace JustLand\JustFunc\v3;

class Resolver
{
  /**
   * ['+' => add, '==' => equality]
   * @var IOperator[]
   */
  private $ops = [];

  /**
   * @param IModule[] $modules
   */
  public function __construct($analyzer, $modules = [])
  {
    $this->analyzer = $analyzer;
    array_unshift($modules, new Not());

    foreach ($modules as $m) {
      $m->register($this);
    }

    // $this->handlers = [
    // Not::KEY => new Not(),
    // Equality::KEY => new Equality(),
    // ListType::KEY => new ListType(),
    // StringType::KEY => StringType::class,
    // IfKeyword::KEY => IfKeyword::class,
    // Add::KEY => Add::class,
    // Subtract::KEY => Subtract::class,
    // Multiply::KEY => Multiply::class,
    // Divide::KEY => Divide::class,
    // Mod::KEY => Mod::class
    // ];
    // $ratio = new RatioType();
    // $ratio->getHandlers();
    // $this->handlers['ratio'] = $ratio;
    // $this->handlers['+ ratio number'] = $ratio;
    // $this->handlers['+ number ratio'] = $ratio;
    // $this->handlers['+ ratio ratio'] = $ratio;
    // $this->handlers['- ratio number'] = $ratio;
    // $this->handlers['- number ratio'] = $ratio;
    // $this->handlers['- ratio ratio'] = $ratio;
    // $this->handlers['* ratio number'] = $ratio;
    // $this->handlers['* number ratio'] = $ratio;
    // $this->handlers['* ratio ratio'] = $ratio;
    // $this->handlers['/ ratio number'] = $ratio;
    // $this->handlers['/ number ratio'] = $ratio;
    // $this->handlers['/ ratio ratio'] = $ratio;
    // $this->handlers['mod ratio number'] = $ratio;
    // $this->handlers['mod number ratio'] = $ratio;
    // $this->handlers['mod ratio ratio'] = $ratio;
  }

  public function defineOperator($op, $instance)
  {
    $this->ops[$op] = $instance;
  }

  /**
   * Define additional signatures for specified `$op`.
   * This is used by types to add function overloads to specific operators.
   * @param string $op
   * @param array $argTypes
   * @param callable|array $handler
   */
  public function defineSignature($op, $argTypes, $handler)
  {
    $opHandler = $this->getOperatorHandler($op);
    $opHandler->addSignatureHandler(
      JustType::buildSignature($op, $argTypes),
      $handler
    );
  }

  /**
   * @return IOperator
   */
  public function getOperatorHandler($op)
  {
    return isset($this->ops[$op]) ? $this->ops[$op] : null;
  }
}
