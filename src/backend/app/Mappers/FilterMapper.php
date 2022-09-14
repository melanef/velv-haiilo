<?php

namespace App\Mappers;

use App\Entities\Filter;

interface FilterMapper
{
    /**
     * @param mixed $input
     *
     * @return Filter[]
     */
    public function map(mixed $input): array;
}
