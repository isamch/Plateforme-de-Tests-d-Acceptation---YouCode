<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz;

use App\Models\User;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = User::role('admin')->first();

        $admin = User::whereRelation('roles', 'name', 'admin')->first();


        Quiz::create([
            'title' => 'General Knowledge Quiz',
            'description' => 'A quiz to test your general knowledge.',
            'user_id' => $admin->id,
        ]);

        Quiz::create([
            'title' => 'Science Quiz',
            'description' => 'A quiz to test your knowledge in science.',
            'user_id' => $admin->id,
        ]);


        Quiz::create([
            'title' => 'History Quiz',
            'description' => 'A quiz to test your knowledge in history.',
            'user_id' => $admin->id,
        ]);
    }
}
