<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api\V2;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result\FileResult;
use Compwright\ShipstationPhp\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/downloads
 */
class Download
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @return ($inline is true ? Result : FileResult)
     * 
     * @see https://docs.shipstation.com/openapi/downloads/download_file
     */
    public function get(string $file, bool $inline = false, ?int $rotation = null): Result|FileResult
    {
        $op = Operation::fromSpec('GET /v2/downloads/%s')
            ->bindArgs($file);
        $queryParams = [];
        if ($inline) {
            $queryParams['download'] = 'string';
            $result = new Result();
        }
        if (!is_null($rotation)) {
            $queryParams['rotation'] = $rotation;
        }
        if (count($queryParams) > 0) {
            $op->setQueryParams($queryParams);
        }
        return $this->client->__invoke($op, $result ?? new FileResult());
    }
}
