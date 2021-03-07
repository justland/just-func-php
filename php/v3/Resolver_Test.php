<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class SubjectOp implements IModule, IOperator
{
  use OperatorTrait;
  public function register($resolver): void
  {
    $resolver->defineOperator('subject', $this);
  }
  public function prepareArgs($context, $op, $rawArgs)
  {
    return $rawArgs;
  }
  public function missingSignature($context, $signature, $op, $args)
  {
  }
}

class Resolver_Test extends TestCase
{
  public function test_signature_function_handler_returns_as_is()
  {
    $s = new SubjectOp();
    list($r) = $this->createTestResolver([$s]);
    $handler = function () {
    };
    $r->defineSignature('subject', [], $handler);
    $this->assertSame($handler, $s->getSignatureHandler('(subject)'));
  }
  public function test_signature_static_method()
  {
    $s = new SubjectOp();
    list($r) = $this->createTestResolver([$s]);
    $r->defineSignature('subject', [], [Resolver_Test::class, 'staticHandler']);
    $h = $s->getSignatureHandler('(subject)');
    $this->assertEquals('static', $h());
  }
  public function test_signature_instance_method()
  {
    $s = new SubjectOp();
    list($r) = $this->createTestResolver([$s]);
    $r->defineSignature('subject', [], [$this, 'instanceHandler']);
    $h = $s->getSignatureHandler('(subject)');
    $this->assertEquals('instance', $h());
  }
  public function test_defineSignature_on_not_exist_operator()
  {
    list($r, $a) = $this->createTestResolver();
    $r->defineSignature('something-not-exist', [], 'instanceHandler');
    $this->assertEquals(
      [UnknownSymbol::create('something-not-exist')],
      $a->getErrors()
    );
  }

  public function instanceHandler()
  {
    return 'instance';
  }

  public static function staticHandler()
  {
    return 'static';
  }

  private function createTestResolver($modules = [])
  {
    $analyzer = new Analyzer();
    $resolver = new Resolver($analyzer, $modules);
    return [$resolver, $analyzer];
  }
}
