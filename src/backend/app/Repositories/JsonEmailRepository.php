<?php

namespace App\Repositories;

use App\Entities\Email;
use App\Exceptions\EntityNotFoundException;
use App\Mappers\EmailMapper;
use Illuminate\Support\Collection;

class JsonEmailRepository implements EmailRepository
{
    /** @var Collection<Email> */
    private Collection $list;

    private bool $isLoaded = false;

    private EmailMapper $mapper;

    public function __construct(EmailMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param string $email
     *
     * @return Email|null
     * @throws EntityNotFoundException
     */
    public function findByEmail(string $email): ?Email
    {
        $this->load();

        $found = $this->list->where('email', '=', $email)->first();

        if (!$found) {
            throw new EntityNotFoundException(['email' => $email], Email::class);
        }

        return $found;
    }

    private function load(): void
    {
        if ($this->isLoaded) {
            return;
        }

        $this->isLoaded = true;
        $this->list = new Collection($this->mapper->map(file_get_contents(storage_path('app/database/emails.json'))));
    }
}
