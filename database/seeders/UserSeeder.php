<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create book',
            'show book',
            'update book',
            'delete book',
        ];
        //buat permission
        collect($permissions)->each(function($item){
            Permission::create(['name' => $item]);
        });

        //user

        $peoples = [
            'admin',
            'user'
        ];

        collect($peoples)->each(function($people){
            Role::create(['name' => $people]);
        });

        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo(Permission::all());

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->assignRole($adminRole);


          //user
        $userRole = Role::findByName('user');
        $userRole->givePermissionTo([
              'create book',
              'show book',
        ]);


    }
}
