<?php

namespace Database\Seeders;

use App\Models\User;

class UsersSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Teste Nome',
            'active' => true,
            'account_id' => 1
        ]);
    }
}
