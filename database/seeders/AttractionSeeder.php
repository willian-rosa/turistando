<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Attraction::factory(50)->create();
    }
}
