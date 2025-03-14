<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use LengthException;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    public function testFromSpec(): void
    {
        $op = Operation::fromSpec('GET /foo');
        $this->assertEquals('GET', $op->getMethod());
        $this->assertCount(0, $op);
        $this->assertFalse($op->hasBody());
        $this->assertEquals('/foo', $op->getUri());
    }

    public function testGetUriWithArgs(): void
    {
        $op = Operation::fromSpec('GET /foo/%s')
            ->bindArgs('bar');
        $this->assertEquals('GET', $op->getMethod());
        $this->assertCount(1, $op);
        $this->assertFalse($op->hasBody());
        $this->assertEquals('/foo/bar', $op->getUri());
    }

    public function testArgsLengthError(): void
    {
        $this->expectExceptionObject(
            new LengthException('Expected 1 args, received 2')
        );

        $op = Operation::fromSpec('GET /foo/%s');
        $op->bindArgs('bar', 'baz');
    }

    public function testGetUriWithQueryParams(): void
    {
        $op = Operation::fromSpec('GET /foo/%s')
            ->bindArgs('bar')
            ->setQueryParams(['baz' => 3]);
        $this->assertEquals('GET', $op->getMethod());
        $this->assertCount(1, $op);
        $this->assertFalse($op->hasBody());
        $this->assertEquals('/foo/bar?baz=3', $op->getUri());
    }

    public function testBody(): void
    {
        $op = Operation::fromSpec('POST /foo')
            ->setBody(['bar' => 'baz']);
        $this->assertEquals('POST', $op->getMethod());
        $this->assertCount(0, $op);
        $this->assertTrue($op->hasBody());
        $this->assertEquals('/foo', $op->getUri());
        $this->assertEquals(['bar' => 'baz'], $op->getBody());
    }
}
