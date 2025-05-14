<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use PHPUnit\Framework\TestCase;

class CarrierTest extends TestCase
{
    use LegacyApiTestTrait;

    public function testLegacyCarrierAddFunds(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Carrier/AddFundsRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Carrier/AddFundsResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->carrier->addFunds('fedex', 20);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertSame(24.14, $result->data()['balance'] ?? null);
    }

    public function testLegacyCarrierGetById(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Carrier/GetByIdRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Carrier/GetByIdResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->carrier->getById('stamps_com');
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertEquals('stamps_com', $result->data()['code'] ?? null);
    }

    public function testLegacyCarrierListAll(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Carrier/ListAllRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Carrier/ListAllResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->carrier->listAll();
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertCount(5, $result->data());
        $this->assertEquals(
            ['stamps_com', 'stamps_com', 'ups', 'fedex', 'endicia'],
            array_column($result->data(), 'code')
        );
    }

    public function testLegacyCarrierListPackages(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Carrier/ListPackagesRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Carrier/ListPackagesResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->carrier->listPackages('stamps_com');
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertCount(17, $result->data());
        $this->assertEquals(
            ['cubic', 'dvd_flat_rate_box', 'flat_rate_envelope', 'flat_rate_legal_envelope', 'flat_rate_padded_envelope', 'large_envelope_or_flat', 'large_flat_rate_box', 'large_package', 'large_video_flat_rate_box', 'letter', 'medium_flat_rate_box', 'package', 'regional_rate_box_a', 'regional_rate_box_b', 'regional_rate_box_c', 'small_flat_rate_box', 'thick_envelope'],
            array_column($result->data(), 'code')
        );
    }

    public function testLegacyCarrierListServices(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Carrier/ListServicesRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Carrier/ListServicesResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->carrier->listServices('fedex');
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertCount(19, $result->data());
        $this->assertEquals(
            ['fedex_ground', 'fedex_home_delivery', 'fedex_2day', 'fedex_2day_am', 'fedex_express_saver', 'fedex_standard_overnight', 'fedex_priority_overnight', 'fedex_first_overnight', 'fedex_1_day_freight', 'fedex_2_day_freight', 'fedex_3_day_freight', 'fedex_first_overnight_freight', 'fedex_ground_international', 'fedex_international_economy', 'fedex_international_priority', 'fedex_international_first', 'fedex_europe_first', 'fedex_international_economy_freight', 'fedex_international_priority_freight'],
            array_column($result->data(), 'code')
        );
    }
}
