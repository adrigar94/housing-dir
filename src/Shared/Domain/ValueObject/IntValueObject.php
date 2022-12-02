<?php

namespace App\Shared\Domain\ValueObject;

use JsonSerializable;
use RuntimeException;

class IntValueObject implements JsonSerializable
{
    protected $min_int = null;
    protected $max_int = null;

    public function __construct(protected int $value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    protected function ensureIsValid(int $int): void
    {
        $this->ensureIsMinIntIsValid($int);
        $this->ensureIsMaxIntIsValid($int);
    }

    private function ensureIsMinIntIsValid(int $int): void
    {
        if (!is_null($this->min_int) and $int < $this->min_int) {
            throw new RuntimeException("Int does not have the required minimum", 500);
        }
    }
    private function ensureIsMaxIntIsValid(int $int): void
    {
        if (!is_null($this->max_int) and $int > $this->max_int) {
            throw new RuntimeException("Int exceeds maximum allowed", 500);
        }
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
