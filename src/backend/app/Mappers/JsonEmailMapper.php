<?php

namespace App\Mappers;

use App\Entities\Email;
use JsonException;

class JsonEmailMapper implements EmailMapper
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
            $email = new Email();
            $email->email = $record['email'];
            $email->id = $record['_id'];

            $mapped[] = $email;
        }

        return $mapped;
    }
}
