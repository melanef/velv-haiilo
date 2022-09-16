<?php

namespace Test\Unit\Mappers;

use App\Mappers\JsonFilterMapper;
use JsonException;
use Tests\TestCase;

class JsonFilterMapperTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testCanMapFromString(): void
    {
        $input = '[{"_id": "60fa8738ddf98b7abc26ee43","name": {"fr": "Tranche d\'age","en": "Age range"},"values": [{"_id": "60fa8738ddf98b7abc26ee44","fr": "- 26","en": "- 26"},{"_id": "60fa8738ddf98b7abc26ee45","fr": "26 - 30","en": "26 - 30"},{"_id": "60fa8738ddf98b7abc26ee46","fr": "31 - 35","en": "31 - 35"},{"_id": "60fa8738ddf98b7abc26ee47","fr": "36 - 40","en": "36 - 40"},{"_id": "60fa8738ddf98b7abc26ee48","fr": "+ 40","en": "+ 40"}]}]';

        $output = (new JsonFilterMapper())->map($input);

        $this->assertIsArray($output);
        $this->assertCount(1, $output);

        $this->assertEquals('60fa8738ddf98b7abc26ee43', $output[0]->id);
        $this->assertEquals('Tranche d\'age', $output[0]->frenchName);
        $this->assertEquals('Age range', $output[0]->englishName);

        $this->assertIsIterable($output[0]->values);
        $this->assertEquals('60fa8738ddf98b7abc26ee44', $output[0]->values[0]->id);
        $this->assertEquals('- 26', $output[0]->values[0]->frenchValue);
        $this->assertEquals('- 26', $output[0]->values[0]->englishValue);

        $this->assertEquals('60fa8738ddf98b7abc26ee45', $output[0]->values[1]->id);
        $this->assertEquals('26 - 30', $output[0]->values[1]->frenchValue);
        $this->assertEquals('26 - 30', $output[0]->values[1]->englishValue);

        $this->assertEquals('60fa8738ddf98b7abc26ee46', $output[0]->values[2]->id);
        $this->assertEquals('31 - 35', $output[0]->values[2]->frenchValue);
        $this->assertEquals('31 - 35', $output[0]->values[2]->englishValue);

        $this->assertEquals('60fa8738ddf98b7abc26ee47', $output[0]->values[3]->id);
        $this->assertEquals('36 - 40', $output[0]->values[3]->frenchValue);
        $this->assertEquals('36 - 40', $output[0]->values[3]->englishValue);

        $this->assertEquals('60fa8738ddf98b7abc26ee48', $output[0]->values[4]->id);
        $this->assertEquals('+ 40', $output[0]->values[4]->frenchValue);
        $this->assertEquals('+ 40', $output[0]->values[4]->englishValue);
    }
}
