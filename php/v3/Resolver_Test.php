<?php

namespace JustLand\JustFunc\v3;

use PHPUnit\Framework\TestCase;

class SubjectOp extends Operator implements IModule, IOperator
{
  public function register($resolver): void
  {
    $resolver->defineOperator('subject', $this);
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
    list($r,, $c) = $this->createTestResolver([$s]);
    $handler = function () {
      return 'local';
    };
    $r->defineSignature('subject', [], $handler);
    $this->assertEquals('local', $s->handle($c, 'subject', []));
  }
  public function test_signature_static_method()
  {
    $s = new SubjectOp();
    list($r,, $c) = $this->createTestResolver([$s]);
    $r->defineSignature('subject', [], [Resolver_Test::class, 'staticHandler']);
    $this->assertEquals('static', $s->handle($c, 'subject', []));
  }
  public function test_signature_instance_method()
  {
    $s = new SubjectOp();
    list($r,, $c) = $this->createTestResolver([$s]);
    $r->defineSignature('subject', [], [$this, 'instanceHandler']);
    $this->assertEquals('instance', $s->handle($c, 'subject', []));
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
    $context = new ExecutionContext($analyzer, $resolver);
    return [$resolver, $analyzer, $context];
  }
}
