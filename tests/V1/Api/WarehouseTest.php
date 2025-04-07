<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\ShipstationPhp\V1\Model\Address;
use PHPUnit\Framework\TestCase;
use Compwright\ShipstationPhp\V1\Model\Warehouse as WarehouseModel;

class WarehouseTest extends TestCase
{
    use LegacyApiTestTrait;

    public function testLegacyListTags(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Warehouse/ListWarehousesRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Warehouse/ListWarehousesResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->warehouse->listAll();
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
    }

    public function testLegacyWarehouseCreateWarehouse(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Warehouse/CreateWarehouseRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Warehouse/CreateWarehouseResponse.json');
        $this->rootHandler->append($expectedResponse);
        $data = (array) json_decode(
            (string) $expectedRequest->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        $body = WarehouseModel::create([
            'warehouseName' => $data['warehouseName'] ?? '',
            'originAddress' => Address::create($data['originAddress'] ?? []),
            'isDefault' => false,
        ]);
        $result = $this->legacy->warehouse->create($body);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertEquals('12345', $result->data()['warehouseId'] ?? '');
    }
}
