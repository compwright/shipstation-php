<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

class PaginatedIterableResult extends IterableResult
{
    public function totalCount(): int
    {
        /** @var array<string, int> */
        $data = $this->data();
        return $data['total'];
    }

    public function currentPage(): int
    {
        /** @var array<string, int> */
        $data = $this->data();
        return $data['page'];
    }

    public function pageLimit(): int
    {
        /** @var array<string, int> */
        $data = $this->data();
        return $data['pages'];
    }

    public function hasMore(): bool
    {
        return $this->currentPage() < $this->pageLimit();
    }
}
