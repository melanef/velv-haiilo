<?php

namespace App\Mappers;

use App\Entities\Attribute;
use App\Entities\Filter;
use Illuminate\Support\Collection;
use JsonException;

class JsonFilterMapper implements FilterMapper
{
    /**
     * @inheritDoc
     * @throws JsonException
     */
    public function map(mixed $input): array
    {
        $raw = json_decode($input, true, 512, JSON_THROW_ON_ERROR);

        $mapped = [];
        foreach ($raw as $record) {
            $filter = new Filter();
            $filter->id = $record['_id'];
            $filter->englishName = $record['name']['en'];
            $filter->frenchName = $record['name']['fr'];

            $filter->values = new Collection();
            foreach ($record['values'] as $valueRecord) {
                $value = new Attribute();
                $value->id = $valueRecord['_id'];
                $value->englishValue = $valueRecord['en'];
                $value->frenchValue = $valueRecord['fr'];

                $filter->values->push($value);
            }

            $mapped[] = $filter;
        }

        return $mapped;
    }
}
