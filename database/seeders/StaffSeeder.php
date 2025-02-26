<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

use App\Models\Staff;


class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $staffRole = Role::where('name', 'staff')->first();


        // $staffUser = User::create([
        //     'first_name' => 'Staff',
        //     'last_name' => 'Member',
        //     'email' => 'staff@example.com',
        //     'password' => Hash::make('staff123'),
        //     'photo' => 'anwar.jpeg',
        //     'address' => 'Staff Avenue, City',
        //     'age' => 30,
        //     'role_id' => $staffRole->id ?? null,
        // ]);


        //   $staffUser = User::create([
        //     'first_name' => 'Staff',
        //     'last_name' => 'Second',
        //     'email' => 'staffSecond@example.com',
        //     'password' => Hash::make('staffSecond123'),
        //     'photo' => 'younnes.jpeg',
        //     'address' => 'Staff Second Avenue, City',
        //     'age' => 30,
        //     'role_id' => $staffRole->id ?? null,
        // ]);

        // ['CME', 'technique', 'administratif']

        // Staff::create([
        //     'speciality' => 'technique',
        //     'user_id' => $staffUser->id,
        // ]);


        // $staffUser->assignRole('staff');


    }
}
