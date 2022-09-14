<?php

namespace App\Mappers;

use App\Entities\Email;

interface EmailMapper
{
    /**
     * @param mixed $input
     *
     * @return Email[]
     */
    public function map(mixed $input): array;
}
