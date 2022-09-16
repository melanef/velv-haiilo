<?php

namespace Test\Unit\Mappers;

use App\Mappers\JsonEmailMapper;
use Tests\TestCase;

class JsonEmailMapperTest extends TestCase
{
    public function testCanMapFromString(): void
    {
        $input = '[{"_id": 123, "email": "name@example.com"}, {"_id": 456, "email": "john.doe@domain.net"}]';

        $output = (new JsonEmailMapper())->map($input);

        $this->assertIsArray($output);
        $this->assertCount(2, $output);

        $this->assertEquals(123, $output[0]->id);
        $this->assertEquals('name@example.com', $output[0]->email);
        $this->assertEquals(456, $output[1]->id);
        $this->assertEquals('john.doe@domain.net', $output[1]->email);
    }
}
