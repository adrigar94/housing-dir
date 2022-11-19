<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

class OrientationsCollection
{
    private $orientations;

    public function __construct(Orientations ...$orientations)
    {
        $this->orientations = $orientations;
    }

    public function values()
    {
        return $this->orientations;
    }

}
