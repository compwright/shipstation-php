<?php

declare(strict_types = 1);

namespace Compwright\ShipstationPhp\V1\Model;

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testCreateJsonSerialize(): void
    {
        $expectedArray = json_decode(
            file_get_contents(__DIR__ . '/Order.json') ?: '',
            true,
            512,
            JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING
        );
        $actualArray = Order::create($expectedArray)->jsonSerialize();
        $this->assertEquals($expectedArray, $actualArray);
    }
}
