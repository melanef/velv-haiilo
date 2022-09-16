<?php

namespace Tests\Unit\Entities;

use App\Entities\Attribute;
use App\Entities\OutputEntry;
use Tests\TestCase;

class OutputEntryTest extends TestCase
{
    public function testCanProduceJsonSerialization(): void
    {
        $output = new OutputEntry();
        $output->id = 123;

        $attribute = new Attribute();
        $attribute->id = 456;
        $output->attributes[] = $attribute;

        $attribute = new Attribute();
        $attribute->id = 789;
        $output->attributes[] = $attribute;

        $serialization = [
            '_id' => 123,
            'attributes' => [456, 789]
        ];

        $this->assertEquals($serialization, $output->jsonSerialize());
    }
}
