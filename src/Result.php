<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use Psr\Http\Message\ResponseInterface;

class Result
{
    private ResponseInterface $response;

    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return array<int|string, mixed>
     */
    public function data(): array
    {
        return (array) json_decode(
            (string) $this->response->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING
        );
    }
}
