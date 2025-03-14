<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Webhook;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class SignedWebhookTest extends TestCase
{
    public function testGetTimestamp(): void
    {
        $request = new SignedWebhook(
            new Request('POST', '/', ['x-shipengine-timestamp' => '42'])
        );
        $this->assertEquals(42, $request->getTimestamp());

        $request2 = new SignedWebhook(
            new Request('POST', '/', [])
        );
        $this->expectException(HeaderException::class);
        $request2->getTimestamp();
    }

    public function testGetUtcDateTime(): void
    {
        $request = new SignedWebhook(
            new Request('POST', '/', ['x-shipengine-timestamp' => '2024-04-04T15:48:44Z'])
        );
        $this->assertEquals('2024-04-04T15:48:44Z', $request->getTimestamp());
        $this->assertEquals('Z', $request->getUtcDateTime()->getTimezone()->getName());
    }

    public function testGetSignature(): void
    {
        $request = new SignedWebhook(
            new Request('POST', '/', ['x-shipengine-rsa-sha256-signature' => 'foo'])
        );
        $this->assertEquals('foo', $request->getSignature());

        $request2 = new SignedWebhook(
            new Request('POST', '/', [])
        );
        $this->expectException(HeaderException::class);
        $request2->getSignature();
    }

    public function testGetPublicKeyId(): void
    {
        $request = new SignedWebhook(
            new Request('POST', '/', ['x-shipengine-rsa-sha256-key-id' => 'bar'])
        );
        $this->assertEquals('bar', $request->getPublicKeyId());

        $request2 = new SignedWebhook(
            new Request('POST', '/', [])
        );
        $this->expectException(HeaderException::class);
        $request2->getPublicKeyId();
    }

    public function testGetDataToSign(): void
    {
        $request = new SignedWebhook(
            new Request('POST', '/', ['x-shipengine-timestamp' => 'foo'], 'bar')
        );
        $this->assertEquals('foo.bar', $request->getDataToSign());
    }
}
