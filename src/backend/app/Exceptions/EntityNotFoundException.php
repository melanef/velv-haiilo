<?php

namespace App\Exceptions;

use Exception;

class EntityNotFoundException extends Exception
{
    private const MESSAGE = 'Entity "%s" not found with these params: %s';

    public array $params;
    public string $entity;

    public function __construct(array $params, string $entity)
    {
        $parts = [];
        foreach ($params as $key => $value) {
            $parts[] = sprintf('%s = %s', $key, $value);
        }

        parent::__construct(sprintf(self::MESSAGE, $entity, implode(' - ', $parts)));
        $this->entity = $entity;
        $this->params = $params;
    }
}
