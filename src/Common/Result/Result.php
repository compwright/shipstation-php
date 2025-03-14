<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Result;

class Result implements ResultInterface
{
    use ResponseAwareTrait;

    /**
     * @return array<int|string, mixed>
     */
    public function data(): array
    {
        $json = (string) $this->response->getBody();

        if ($json === '') {
            return [];
        }

        return (array) json_decode(
            $json,
            true,
            512,
            JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING
        );
    }
}
