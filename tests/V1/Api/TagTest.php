<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    use LegacyApiTestTrait;

    public function testLegacyListTags(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Tag/ListTagsRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Tag/ListTagsResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->tag->listAll();
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
    }
}
