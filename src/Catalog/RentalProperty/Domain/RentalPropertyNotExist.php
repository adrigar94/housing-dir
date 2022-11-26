<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\PropertyId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class RentalPropertyNotExist extends HttpException
{
    public function __construct(private readonly PropertyId $id)
    {
        parent::__construct(Response::HTTP_NOT_FOUND, $this->errorMessage());
    }

    protected function errorMessage(): string
    {
        return sprintf('The rental property <%s> does not exist', $this->id->value());
    }
}
