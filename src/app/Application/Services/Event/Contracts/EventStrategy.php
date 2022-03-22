<?php

namespace App\Application\Services\Event\Contracts;

use App\Domain\Entities\Event\EventEntity;

interface EventStrategy
{
    public function create(EventEntity $entity): array;
}
