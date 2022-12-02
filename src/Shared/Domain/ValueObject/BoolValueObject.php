<?php

namespace App\Shared\Domain\ValueObject;

use JsonSerializable;

class BoolValueObject implements JsonSerializable
{
    public function __construct(protected bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function jsonSerialize(): bool
    {
        return $this->value();
    }
}
