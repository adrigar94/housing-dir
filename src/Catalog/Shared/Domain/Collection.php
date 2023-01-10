<?php

declare(strict_types=1);

namespace App\Catalog\Shared\Domain;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;

abstract class Collection implements Countable, IteratorAggregate
{
    public function __construct(private readonly array $items)
    {
        $class = $this->type();
        foreach ($items as $item) {
            if (!$item instanceof $class) {
                throw new InvalidArgumentException(
                    sprintf('The object <%s> is not an instance of <%s>', $class, $item::class)
                );
            }
        }
    }

    abstract protected function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    protected function items(): array
    {
        return $this->items;
    }
}
