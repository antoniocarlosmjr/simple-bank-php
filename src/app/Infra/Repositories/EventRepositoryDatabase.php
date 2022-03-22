<?php

namespace App\Infra\Repositories;

use App\Application\Repositories\EventRepositoryInterface;
use App\Domain\Entities\Event\EventEntity;
use App\Driver\Models\EventModel;
use Illuminate\Support\Collection;

class EventRepositoryDatabase implements EventRepositoryInterface
{
    public function __construct(
        private EventModel $eventModelEloquent
    ) {
    }

    /**
     * Create a new event
     *
     * @param EventEntity $entity
     * @return EventEntity
     */
    public function create(EventEntity $entity): EventEntity
    {
        $modelRegister = $this->eventModelEloquent::create($entity->toArray());
        dd($entity->toArray());
        dd($modelRegister);
        $register = $this->transformPayload(
            collect([$modelRegister])
        )->collapse()->all();
        return $entity->fill($register);
    }

    /**
     * Update of the event.
     *
     * @param EventEntity $entity
     * @return EventEntity
     */
    public function update(EventEntity $entity): EventEntity
    {
        $this->eventModelEloquent::where(['id' => $entity->getId()])->update($entity->toArray());
        return $entity->fill($entity->toArray());
    }

    /**
     * Transform payload return
     *
     * @param Collection $collect
     * @return Collection
     */
    private function transformPayload(Collection $collect): Collection
    {
        return $collect->transform(function ($item) {
            return [
                'id' => $item->id,
                'account_id_origin' => $item->account_id_origin,
                'account_id_destination' => $item->account_id_destination,
                'amount' => $item->amount,
            ];
        });
    }
}
