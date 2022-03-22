<?php

namespace App\Application\Repositories;

use App\Domain\Entities\Event\EventEntity;

interface EventRepositoryInterface
{
    public function create(EventEntity $entity): EventEntity;
    public function update(EventEntity $entity): EventEntity;
}
