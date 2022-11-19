<?php

namespace App\Shared\Domain\ValueObject;

use RuntimeException;

class IntValueObject
{
    protected $min_int = null;
    protected $max_int = null;

    protected $value;

    public function __construct(int $value)
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
        if(!is_null($this->min_int) AND $int < $this->min_int){
            throw new RuntimeException("Int does not have the required minimum", 500);
        }
    }
    private function ensureIsMaxIntIsValid(int $int): void
    {
        if(!is_null($this->max_int) AND $int > $this->max_int){
            throw new RuntimeException("Int exceeds maximum allowed", 500);
        }
    }
}
