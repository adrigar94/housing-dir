<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Find;

use App\Shared\Domain\Bus\Query\Query;

class FindRentalPropertyQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

}