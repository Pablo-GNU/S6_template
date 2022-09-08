<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection  implements Countable, IteratorAggregate
{
    private $items;

    public function __construct(array $items)
    {
        Assert::arrayOf(static::type(), $items);

        $this->items = $items;
    }

    abstract protected static function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return \count($this->items());
    }

    public function isEmpty(): bool
    {
        return empty($this->count());
    }

    public function addItem(mixed $item): void
    {
        Assert::instanceOf(static::type(), $item);
        $this->items[] = $item;
    }

    protected function items(): array
    {
        return $this->items;
    }
}