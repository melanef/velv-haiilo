<?php

namespace App\Repositories;

use App\Entities\Filter;
use App\Exceptions\EntityNotFoundException;
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

    /**
     * @throws EntityNotFoundException
     */
    public function findByEnglishName(string $name): Filter
    {
        $this->load();

        $found = $this->list->where('englishName', '=', $name)->first();

        if (!$found) {
            throw new EntityNotFoundException(['englishName' => $name], Filter::class);
        }

        return $found;
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
