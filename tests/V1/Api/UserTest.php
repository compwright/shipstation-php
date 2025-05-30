<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use LegacyApiTestTrait;

    public function testLegacyListTags(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/User/ListUsersRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/User/ListUsersResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->user->listAll();
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
    }
}
