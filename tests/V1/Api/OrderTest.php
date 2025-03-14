<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api\Order;

use Compwright\ShipstationPhp\BaseApiTest;
use Compwright\ShipstationPhp\V1\Model\Order;

class OrderTest extends BaseApiTest
{
    public function testLegacyOrderAddTags(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/AddTagRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/AddTagResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->addTag(123456, 1234);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }

    public function testLegacyOrderAssignUser(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/AssignUserRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/AssignUserResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->assignUser('123456AB-ab12-3c4d-5e67-89f1abc1defa', 123456789, 12345679);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }

    public function testLegacyOrderCreateLabel(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/CreateLabelForOrderRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/CreateLabelForOrderResponse.json');
        $this->rootHandler->append($expectedResponse);
        /** @var array<string, mixed> */
        $body = json_decode(
            (string) $expectedRequest->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        $result = $this->legacy->order->createLabel($body);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertEquals('248201115029520', $result->data()['trackingNumber'] ?? '');
    }

    public function testLegacyOrderCreateOrUpdateMultiple(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/CreateOrdersRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/CreateOrdersResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->createOrUpdateMultiple(
            Order::createList(
                (array) json_decode(
                    (string) $expectedRequest->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                )
            )
        );
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertCount(2, $result);
        $this->assertEquals(
            [168426889, 168432343],
            array_column(iterator_to_array($result), 'orderId')
        );
    }

    public function testLegacyOrderCreateOrUpdate(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/CreateOrderRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/CreateOrderResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->createOrUpdate(
            Order::create(
                json_decode(
                    (string) $expectedRequest->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                )
            )
        );
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertEquals('140335319', $result->data()['orderId'] ?? '');
    }

    public function testLegacyOrderDelete(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/DeleteOrderRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/DeleteOrderResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->delete('orderId');
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }

    public function testLegacyOrderGetById(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/GetOrderRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/GetOrderResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->getById('orderId');
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertEquals(94113592, $result->data()['orderId'] ?? null);
    }

    public function testLegacyOrderHoldUntil(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/HoldUntilRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/HoldUntilResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->holdUntil(1072467, "2014-12-01");
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }

    public function testLegacyOrderListByTag(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/ListByTagRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/ListByTagResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->listByTag([
            'orderStatus' => 'orderStatus',
            'tagId' => 'tagId',
            'page' => 1,
            'pageSize' => 25,
        ]);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertCount(1, $result);
        $this->assertEquals(1, $result->totalCount());
        $this->assertEquals(1, $result->currentPage());
        $this->assertEquals(1, $result->pageLimit());
        $this->assertEquals(
            [123456789],
            array_column(iterator_to_array($result), 'orderId')
        );
    }

    public function testLegacyOrderListAll(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/ListOrdersRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/ListOrdersResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->listAll([
            'customerName' => 'customerName',
            'itemKeyword' => 'itemKeyword',
            'createDateStart' => 'createDateStart',
            'createDateEnd' => 'createDateEnd',
            'modifyDateStart' => 'modifyDateStart',
            'modifyDateEnd' => 'modifyDateEnd',
            'orderDateStart' => 'orderDateStart',
            'orderDateEnd' => 'orderDateEnd',
            'orderNumber' => 'orderNumber',
            'orderStatus' => 'orderStatus',
            'paymentDateStart' => 'paymentDateStart',
            'paymentDateEnd' => 'paymentDateEnd',
            'storeId' => 'storeId',
            'sortBy' => 'sortBy',
            'sortDir' => 'sortDir',
            'page' => 'page',
            'pageSize' => 'pageSize',
        ]);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertCount(2, $result);
        $this->assertEquals(2, $result->totalCount());
        $this->assertEquals(1, $result->currentPage());
        $this->assertEquals(1, $result->pageLimit());
        $this->assertEquals(
            [987654321, 123456789],
            array_column(iterator_to_array($result), 'orderId')
        );
    }

    public function testLegacyOrderMarkShipped(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/MarkAsShippedRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/MarkAsShippedResponse.json');
        $this->rootHandler->append($expectedResponse);
        /** @var array<string, mixed> */
        $body = json_decode(
            (string) $expectedRequest->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        $result = $this->legacy->order->markShipped($body);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertEquals(123456789, $result->data()['orderId'] ?? null);
    }

    public function testLegacyOrderRemoveTag(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/RemoveTagRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/RemoveTagResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->removeTag(123456, 1234);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }

    public function testLegacyOrderRestoreFromHold(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/RestoreFromHoldRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/RestoreFromHoldResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->restoreFromHold(1234567);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }

    public function testLegacyOrderUnassign(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/Order/UnassignUserRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/Order/UnassignUserResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->order->unassign(123456789, 12345679);
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
        $this->assertTrue($result->data()['success'] ?? null);
    }
}
