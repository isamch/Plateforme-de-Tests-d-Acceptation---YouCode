<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;


use App\Models\User;
use App\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::where('name', 'admin')->first();



        // $adminUser = User::create([
        //     'first_name' => 'Admin',
        //     'last_name' => 'User',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('admin123'),
        //     'photo' => 'admin.jpg',
        //     'address' => 'Admin Street, City',
        //     'age' => 35,
        //     'role_id' => $adminRole->id ?? null,
        // ]);


        // $adminUser->assignRole('admin');



    }
}
