<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Archive;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Archive::create([
            'metadesc' => 'VScode住民の探検記'
        ]);
    }
}
