<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Tests\Shared\Domain\DomainError;

final class RentalPropertyNotExist extends DomainError
{
    public function __construct(private readonly PropertyId $id)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'rental_property_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The rental property <%s> does not exist', $this->id->value());
    }
}
