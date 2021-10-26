<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->withPersonalTeam()->create([
            'name' => 'Ricardo',
            'email' => 'rbartolome@sanaval.com',
          //  'username' => 'ricardo.bm',
        ]);

        User::factory(9)->create();

    }
}
