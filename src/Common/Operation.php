<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common;

use Countable;
use LengthException;
use RuntimeException;

class Operation implements Countable
{
    /** @var int[]|string[] $args */
    private array $args;

    /** @var array<string, mixed> */
    private array $query;

    /** @var mixed $body */
    private $body;

    /**
     * @param int<0, max> $arity
     */
    public function __construct(
        private string $method,
        private string $uri,
        private int $arity
    ) {
    }

    public static function fromSpec(string $spec): self
    {
        $parts = explode(' ', $spec);
        $method = strtoupper(implode(array_splice($parts, 0, 1)));
        $uri = implode(' ', $parts);
        $arity = substr_count($uri, '%s');
        return new self($method, $uri, $arity);
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
     * @throws LengthException
     */
    public function bindArgs(int|string ...$args): self
    {
        if (count($args) !== $this->arity) {
            throw new LengthException(sprintf(
                'Expected %d args, received %d',
                $this->arity,
                count($args)
            ));
        }

        $this->args = array_map(
            fn ($a) => urlencode((string) $a),
            $args
        );

        return $this;
    }

    public function getUri(): string
    {
        if ($this->arity > 0 && !isset($this->args)) {
            throw new RuntimeException(sprintf(
                'Missing %d args, call bindArgs() first',
                $this->arity
            ));
        }

        if (isset($this->args)) {
            return sprintf($this->uri, ...$this->args);
        }

        return $this->uri;
    }

    /**
     * @param array<string, mixed> $query
     */
    public function setQueryParams(array $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function hasQueryParams(): bool
    {
        return isset($this->query);
    }

    /**
     * @return array<string, mixed>
     */
    public function getQueryParams(): array
    {
        return $this->query;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): self
    {
        $this->body = $body;
        return $this;
    }

    public function hasBody(): bool
    {
        return isset($this->body);
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}
