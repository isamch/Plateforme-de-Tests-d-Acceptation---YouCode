<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

use App\Models\Candidat;


class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidatRole = Role::where('name', 'candidat')->first();


        // $candidatUser = User::create([
        //     'first_name' => 'Candidat',
        //     'last_name' => 'Member',
        //     'email' => 'Candidat@example.com',
        //     'password' => Hash::make('Candidat123'),
        //     'photo' => 'hamzasghir.jpeg',
        //     'address' => 'Candidat Avenue, City',
        //     'age' => 20,
        //     'role_id' => $candidatRole->id ?? null,
        // ]);



        // $candidatUser = User::create([
        //     'first_name' => 'Candidat',
        //     'last_name' => 'second',
        //     'email' => 'CandidatSecond@example.com',
        //     'password' => Hash::make('CandidatSecond123'),
        //     'photo' => 'ziko.jpeg',
        //     'address' => 'Candidat Avenue, City',
        //     'age' => 23,
        //     'role_id' => $candidatRole->id ?? null,
        // ]);



        // Candidat::create([
        //     'card_path' => 'card1.png',
        //     'user_id' => $candidatUser->id,
        // ]);


        // $candidatUser->assignRole('candidat');
    }
}
