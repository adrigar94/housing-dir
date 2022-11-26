<?php

namespace App\Tests\Shared\Domain;

use DomainException;

abstract class DomainError extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    abstract public function errorCode(): string;

    abstract protected function errorMessage(): string;
}
