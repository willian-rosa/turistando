<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VideoAttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\VideoAttraction::factory(50)->create();
    }
}
