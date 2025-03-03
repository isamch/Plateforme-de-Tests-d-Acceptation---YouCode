<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;


class MigrateCustomOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:isam-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migration in my order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $paths = [
            // users and role
            'database/migrations/2025_02_26_115127_create_permission_tables.php',

            // table intermediat

            'database/migrations/2014_10_12_000000_create_users_table.php',
            'database/migrations/2025_02_25_180140_create_candidats_table.php',
            'database/migrations/2025_02_25_205952_create_staff_table.php',

            // quiz
            'database/migrations/2025_02_25_172343_create_quizzes_table.php',
            'database/migrations/2025_02_25_172505_create_questions_table.php',

            // table intermediat
            'database/migrations/2025_02_25_203903_create_question_quiz_table.php',

            'database/migrations/2025_02_25_173628_create_options_table.php',
            'database/migrations/2025_02_25_185259_create_candidat_quizzes_table.php',
            'database/migrations/2025_02_25_185748_create_candidat_options_table.php',




            'database/migrations/2014_10_12_100000_create_password_resets_table.php',
            'database/migrations/2019_08_19_000000_create_failed_jobs_table.php',
            'database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php',
        ];




        // traitement:
        foreach ($paths as $path) {
            $this->info("Running migration: $path");
            $exitCode = Artisan::call('migrate', ['--path' => $path]);


            if ($exitCode !== 0) {
                $this->error("Migration failed: $path");
                return;
            }
        }


        $this->info('All migrations executed successfully!');



    }
}
