<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // set data in role:
        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);
        $candidat = Role::create(['name' => 'candidat']);

        // set data in permission:
        $permissions = [

            // quiz :

                // for admin:
                'create_quizzes',
                'view_quizzes',
                'update_quizzes',
                'delete_quizzes',
                'active_quiz',

                // for candidat:
                'start_quiz',
                'submit_quiz', //end


            // question:
                // for admin and staff:
                'create_questions',
                'view_questions',
                'update_questions',
                'delete_questions',


            // analytics:

                'view_statistics', //view all statistic for
                'view_results',
                'delete_results',


        ];



        // set data in Role_Permission:



    }
}
