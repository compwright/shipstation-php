<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Result;

use Psr\Http\Message\StreamInterface;

class FileResult implements ResultInterface
{
    use ResponseAwareTrait;

    public function stream(): StreamInterface
    {
        return $this->getResponse()->getBody();
    }
}
