<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\StaffEvent;
use App\Models\Staff;


class StaffEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            $startTime = $faker->dateTimeBetween('2025-03-13 08:00:00', '2025-03-13 11:00:00');
            $endTime = $faker->dateTimeBetween($startTime, $startTime->modify('+1 hour'));

            $event = StaffEvent::create([
                'title' => $faker->word(),
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);


            $staff = Staff::all()->random(1);
            $event->staff()->attach($staff);

        }
    }
}
