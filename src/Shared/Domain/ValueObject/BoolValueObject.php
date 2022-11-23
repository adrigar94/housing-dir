<?php

namespace App\Shared\Domain\ValueObject;

class BoolValueObject
{
    public function __construct(protected bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }
}
