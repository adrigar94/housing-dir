<?php

declare(strict_types=1);

namespace App\Catalog\Shared\Domain\Criteria;

use App\Catalog\Shared\Domain\Collection;

final class Filters extends Collection
{
    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    private static function filterBuilder(): callable
    {
        return fn (array $values) => Filter::fromValues($values);
    }

    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

    public function filters(): array
    {
        return $this->items();
    }

    public function serialize(): string
    {
        return array_reduce(
            $this->items(),
            fn (string $accumulate, Filter $filter) => sprintf('%s^%s', $accumulate, $filter->serialize()),
            ''
        );
    }

    protected function type(): string
    {
        return Filter::class;
    }
}
