<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Webhook;

use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;

class SignedWebhook
{
    final public function __construct(private RequestInterface $request)
    {
    }

    /**
     * @throws HeaderException
     */
    protected function getRequiredHeader(string $header): string
    {
        if (!$this->request->hasHeader($header)) {
            throw new HeaderException('Missing required header: ' . $header);
        }

        $value = $this->request->getHeaderLine($header);

        if (empty($value)) {
            throw new HeaderException('Required header is blank: ' . $header);
        }

        return $value;
    }

    public function getTimestamp(): string
    {
        return $this->getRequiredHeader('x-shipengine-timestamp');
    }

    public function getUtcDateTime(): DateTimeImmutable
    {
        return new DateTimeImmutable(
            $this->getTimestamp()
        );
    }

    public function getSignature(): string
    {
        return $this->getRequiredHeader('x-shipengine-rsa-sha256-signature');
    }

    public function getAlgorithm(): int
    {
        return OPENSSL_ALGO_SHA256;
    }

    public function getPublicKeyId(): string
    {
        return $this->getRequiredHeader('x-shipengine-rsa-sha256-key-id');
    }

    public function getDataToSign(): string
    {
        return $this->getTimestamp() . '.' . $this->request->getBody();
    }
}
