<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int, array<string, mixed>>
 */
class IterableResult extends Result implements IteratorAggregate, Countable
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getArray(): array
    {
        $data = (array) $this->data();
        /** @var array<int, array<string, mixed>> */
        $data = $data[$this->key] ?? [];
        return $data;
    }

    public function count(): int
    {
        return count($this->getArray());
    }

    /**
     * @return ArrayIterator<int, array<string, mixed>>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator(
            $this->getArray()
        );
    }
}
