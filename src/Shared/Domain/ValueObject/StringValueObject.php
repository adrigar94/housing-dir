<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use RuntimeException;

abstract class StringValueObject
{
    protected $min_length = null;
    protected $max_length = null;

    protected $value;

    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    protected function ensureIsValid(string $string): void
    {
        $this->ensureIsMinLengthIsValid($string);
        $this->ensureIsMaxLengthIsValid($string);
    }

    private function ensureIsMinLengthIsValid(string $string): void
    {
        if($this->min_length AND strlen($string) < $this->min_length){
            throw new RuntimeException("PropertyTitle does not have the required minimum length", 500);
        }
    }
    private function ensureIsMaxLengthIsValid(string $string): void
    {
        if($this->max_length AND strlen($string) > $this->max_length){
            throw new RuntimeException("PropertyTitle exceeds maximum allowed length", 500);
        }
    }
}