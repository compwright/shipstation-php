<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1;

use Compwright\ShipstationPhp\ApiClient;

class LegacyApiCollection
{
    public readonly Api\Order $order;
    public readonly Api\Tag $tag;

    public function __construct(ApiClient $client)
    {
        $this->order = new Api\Order($client);
        $this->tag = new Api\Tag($client);
    }
}
