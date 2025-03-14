<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Result;

use Psr\Http\Message\ResponseInterface;

interface ResultInterface
{
    public function hasResponse(): bool;

    /**
     * @return static
     */
    public function setResponse(ResponseInterface $response): self;

    public function getResponse(): ResponseInterface;
}
