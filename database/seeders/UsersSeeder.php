<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::truncate();
        Role::truncate();
        User::truncate();

        $rootRole = Role::create(['name'=>'Root']);
        $adminRole = Role::create(['name'=>'Admin']);
        //$supRole = Role::create(['name'=>'Supervisor']);

        Permission::create(['name'=>'users','nombre'=>'Acceso a Usuarios']);

        $user = User::factory()->withPersonalTeam()->create([
            'name' => 'Ricardo',
            'email' => 'rbartolome@sanaval.com',
          //  'username' => 'ricardo.bm',
        ]);

        User::factory(9)->create();

        $user->assignRole($rootRole);
        $user->assignRole($adminRole);
        $user->givePermissionTo('users');
    }
}
