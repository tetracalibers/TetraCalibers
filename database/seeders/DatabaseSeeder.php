<?php

namespace Database\Seeders;

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
        $this->call([
            //UserSeeder::class,
            //UseableToolSeeder::class
            //ProfileSeeder::class,
            //ReadingNoteSeeder::class
            SubjectSeeder::class,
            LearningUnitSeeder::class,
            ClearnoteSeeder::class,
        ]);
    }
}
