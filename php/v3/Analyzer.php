<?php

namespace JustLand\JustFunc\v3;

class Analyzer
{
  /**
   * @var array Contains the error information about the execution.
   */
  private $errors = [];

  public function reset()
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
}
