<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'profile' => '理系学問に夢中だった時代を経て、今はなんでも引き受けられるマルチなプログラマを目指して奮闘中。'
        ]);
    }
}
