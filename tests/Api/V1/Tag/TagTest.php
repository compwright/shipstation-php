<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api\V1\Tag;

use Compwright\ShipstationPhp\Api\BaseApiTest;

class TagTest extends BaseApiTest
{
    public function testLegacyListTags(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/ListTagsRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/ListTagsResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->tag->listAll();
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
    }
}
