<?php

namespace Database\Factories;

use App\Driver\Models\EventModel;
use App\Enumerators\EventStatusEnum;
use App\Enumerators\EventTypesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventModelFactory extends Factory
{
    protected $model = EventModel::class;

    public function definition(): array
    {
        return [
            'type'   => $this->faker->randomElements(
                [
                    EventTypesEnum::DEPOSIT,
                    EventTypesEnum::WITHDRAW,
                    EventTypesEnum::TRANSFER
                ]
            ),
            'status'        => EventStatusEnum::STARTED,
            'amount'    => $this->faker->randomFloat(2),
            'account_id_origin' => $this->faker->randomDigit(),
            'account_id_destination' => $this->faker->randomDigit(),
            'created_at'    => $this->faker->date(),
        ];
    }
}
