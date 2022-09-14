<?php

namespace App\Repositories;

use App\Entities\Filter;
use App\Mappers\FilterMapper;
use Illuminate\Support\Collection;

class JsonFilterRepository implements FilterRepository
{
    /** @var Collection<Filter> */
    private Collection $list;

    private bool $isLoaded = false;

    private FilterMapper $mapper;

    public function __construct(FilterMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function findByEnglishName(string $name): Filter
    {
        $this->load();

        return $this->list->where('englishName', '=', $name)->first();
    }

    private function load(): void
    {
        if ($this->isLoaded) {
            return;
        }

        $this->isLoaded = true;
        $this->list = new Collection($this->mapper->map(file_get_contents(storage_path('app/database/filters.json'))));
    }
}
