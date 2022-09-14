<?php

namespace App\Repositories;

use App\Entities\Email;

interface EmailRepository
{
    /**
     * @param string $email
     *
     * @return Email|null
     */
    public function findByEmail(string $email): ?Email;
}
