<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Result;

class PaginatedIterableResult extends IterableResult
{
    public function totalCount(): int
    {
        /** @var array<string, int> */
        $data = $this->data();
        return $data['total'] ?? 0;
    }

    public function currentPage(): int
    {
        /** @var array<string, int> */
        $data = $this->data();
        return $data['page'] ?? 1;
    }

    public function pageLimit(): int
    {
        /** @var array<string, int> */
        $data = $this->data();
        return $data['pages'] ?? 1;
    }

    public function hasMore(): bool
    {
        return $this->currentPage() < $this->pageLimit();
    }
}
