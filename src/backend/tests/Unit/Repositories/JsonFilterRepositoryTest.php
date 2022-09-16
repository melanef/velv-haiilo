<?php

namespace Tests\Unit\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Mappers\JsonFilterMapper;
use App\Repositories\FilterRepository;
use App\Repositories\JsonFilterRepository;
use Tests\TestCase;

class JsonFilterRepositoryTest extends TestCase
{
    private FilterRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new JsonFilterRepository(new JsonFilterMapper());
    }

    /**
     * @throws EntityNotFoundException
     */
    public function testCanFindExistingRecord(): void
    {
        $id = '60fa8738ddf98b7abc26ee49';
        $name = 'Salary bracket';

        $found = $this->repository->findByEnglishName($name);

        $this->assertNotNull($found);
        $this->assertIsObject($found);
        $this->assertEquals($name, $found->englishName);
        $this->assertEquals($id, $found->id);
    }

    public function testThrowsExceptionForNonExistingRecord(): void
    {
        $name = 'Tranche de salaire';

        $this->expectException(EntityNotFoundException::class);

        $this->repository->findByEnglishName($name);
    }
}
