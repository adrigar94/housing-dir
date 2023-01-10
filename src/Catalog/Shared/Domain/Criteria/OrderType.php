<?php

declare(strict_types=1);

namespace App\Catalog\Shared\Domain\Criteria;

enum OrderType: string
{
    case ASC = 'ASC';
    case DESC = 'DESC';
    case NONE = 'NONE';

    public function isNone(): bool
    {
        return $this->value === self::NONE;
    }
}
