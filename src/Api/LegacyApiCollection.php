<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api;

use Compwright\ShipstationPhp\ApiClient;

class LegacyApiCollection
{
    public readonly V1\Order $order;
    public readonly V1\Tag $tag;

    public function __construct(ApiClient $client)
    {
        $this->order = new V1\Order($client);
        $this->tag = new V1\Tag($client);
    }
}
