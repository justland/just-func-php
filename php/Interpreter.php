<?php

namespace justland\JustFunc;

class Interpreter
{
  /**
   * @var array|null Contains the error information about the execution.
   */
  public $errors;
  /**
   * @param array $code just-func code
   */
  public function execute($code)
  {
    $this->resetErrors();
    if (!is_array($code)) return self::literal($code);
    if (count($code) === 0) return null;
    $op = $code[0];
    switch ($op) {
      case 'not':
        return $this->not($code);
    }
  }

  private function resetErrors()
  {
    $this->errors = null;
  }

  private function addError($errorInfo)
  {
    if (!$this->errors) $this->errors = [];
    array_push($this->errors, $errorInfo);
  }

  private static function literal($code)
  {
    return $code;
  }

  private function not($code)
  {
    if (count($code) === 2) {
      $value = $code[1];
      if ($value === true) return false;
      if ($value === false) return true;
    }
    $this->addError([
      'type' => 'InvalidType',
      'op' => $code,
      'message' => "The 'not' function expects a single boolean value"
    ]);
    return null;
  }
}
