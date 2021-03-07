<?php

namespace JustLand\JustFunc\v2;

class ModuleResolver
{
  private $handlers = [];

  public function __construct()
  {
    $this->handlers = [
      Not::KEY => new Not(),
      Equality::KEY => new Equality(),
      ListType::KEY => new ListType(),
      // StringType::KEY => StringType::class,
      // IfKeyword::KEY => IfKeyword::class,
      // Add::KEY => Add::class,
      // Subtract::KEY => Subtract::class,
      // Multiply::KEY => Multiply::class,
      // Divide::KEY => Divide::class,
      // Mod::KEY => Mod::class
    ];
    $ratio = new RatioType();
    // $ratio->getHandlers();
    $this->handlers['ratio'] = $ratio;
    $this->handlers['+ ratio number'] = $ratio;
    $this->handlers['+ number ratio'] = $ratio;
    $this->handlers['+ ratio ratio'] = $ratio;
    $this->handlers['- ratio number'] = $ratio;
    $this->handlers['- number ratio'] = $ratio;
    $this->handlers['- ratio ratio'] = $ratio;
    $this->handlers['* ratio number'] = $ratio;
    $this->handlers['* number ratio'] = $ratio;
    $this->handlers['* ratio ratio'] = $ratio;
    $this->handlers['/ ratio number'] = $ratio;
    $this->handlers['/ number ratio'] = $ratio;
    $this->handlers['/ ratio ratio'] = $ratio;
    $this->handlers['mod ratio number'] = $ratio;
    $this->handlers['mod number ratio'] = $ratio;
    $this->handlers['mod ratio ratio'] = $ratio;
  }

  public function register($signature, $handler)
  {

  }
  /**
   * @param ExecutionContext $context
   */
  public function getType($context, $value) {
    if (is_array($value)) {
      // No empty array should reach here.
      return $value[0];
    }
    return gettype($value);
  }
  /**
   * Resolve handler by $key.
   * $key is the signature of the function call.
   * e.g. `+ ratio number` or `+ number ratio`
   */
  public function resolve($key)
  {
    return isset($this->handlers[$key]) ? $this->handlers[$key] : null;
  }
}
