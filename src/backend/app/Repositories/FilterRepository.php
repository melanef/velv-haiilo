<?php

namespace App\Repositories;

use App\Entities\Filter;

interface FilterRepository
{
    public function findByEnglishName(string $name): Filter;
}
