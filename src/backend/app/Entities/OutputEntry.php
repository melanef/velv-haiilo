<?php

namespace App\Entities;

use JsonSerializable;

class OutputEntry implements JsonSerializable
{
    public string $id;

    public array $attributes = [];

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $output = [
            '_id' => $this->id,
            'attributes' => [],
        ];

        foreach ($this->attributes as $attribute) {
            if ($attribute) {
                $output['attributes'][] = $attribute->id;
            }
        }

        return $output;
    }
}
