<?php

namespace JustLand\JustFunc;

class ExecutionContext
{
  /**
   * @var array|null Contains the error information about the execution.
   */
  public $errors;

  public function resetErrors()
  {
    $this->errors = null;
  }

  public function addError($errorInfo)
  {
    if (!$this->errors) $this->errors = [];
    array_push($this->errors, $errorInfo);
  }
}
