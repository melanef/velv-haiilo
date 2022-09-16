<?php

namespace Tests\Unit\Repositories;

use App\Exceptions\EntityNotFoundException;
use App\Mappers\JsonEmailMapper;
use App\Repositories\EmailRepository;
use App\Repositories\JsonEmailRepository;
use Tests\TestCase;

class JsonEmailRepositoryTest extends TestCase
{
    private EmailRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new JsonEmailRepository(new JsonEmailMapper());
    }

    /**
     * @throws EntityNotFoundException
     */
    public function testCanFindExistingRecord(): void
    {
        $id = '60fa8738ddf98b7abc26eeae';
        $email = 'gilles57@hoolie.com';

        $found = $this->repository->findByEmail($email);

        $this->assertNotNull($found);
        $this->assertIsObject($found);
        $this->assertEquals($email, $found->email);
        $this->assertEquals($id, $found->id);
    }

    public function testThrowsExceptionForNonExistingRecord(): void
    {
        $email = 'name@example.com';

        $this->expectException(EntityNotFoundException::class);

        $this->repository->findByEmail($email);
    }
}
