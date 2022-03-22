<?php

namespace Database\Factories;

use App\Driver\Models\AccountModel;
use App\Enumerators\AccountTypesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountModelFactory extends Factory
{
    protected $model = AccountModel::class;

    public function definition(): array
    {
        return [
            'type'   => $this->faker->randomElements(
                [
                    AccountTypesEnum::SAVING,
                    AccountTypesEnum::CHAIN
                ]
            ),
            'active'        => true,
            'balance'    => $this->faker->randomFloat(2),
            'created_at'    => $this->faker->date(),
        ];
    }
}
