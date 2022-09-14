<?php

namespace App\Entities;

use Illuminate\Support\Collection;

class Filter
{
    public string $id;

    public string $englishName;

    public string $frenchName;

    /** @var Collection<Attribute> */
    public Collection $values;
}
