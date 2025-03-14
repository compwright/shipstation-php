<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use Countable;
use LengthException;
use Psr\Http\Message\UriInterface;

class Operation implements Countable
{
    private string $method;

    private string $uri;

    private int $arity;

    public function __construct(string $spec)
    {
        $parts = explode(' ', $spec);
        $this->method = strtoupper(implode(array_splice($parts, 0, 1)));
        $this->uri = implode(' ', $parts);
        $this->arity = substr_count($this->uri, '%s');
    }

    public function count(): int
    {
        return $this->arity;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param array<int|string> $args
     * 
     * @throws LengthException
     */
    public function interpolateUriArgs(array $args, UriInterface $baseUri): UriInterface
    {
        $basePath = $baseUri->getPath();

        if ($this->arity === 0) {
            return $baseUri->withPath(
                $basePath . $this->uri
            );
        }

        if (count($args) !== $this->arity) {
            throw new LengthException(sprintf(
                'Expected %d args, received %d',
                $this->arity,
                count($args)
            ));
        }

        $args = array_map(
            fn ($a) => urlencode((string) $a),
            $args
        );

        $uriStr = $basePath . sprintf($this->uri, ...$args);

        return $baseUri->withPath($uriStr);
    }
}
