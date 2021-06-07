<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhotoAttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PhotoAttraction::factory(50)->create();
    }
}
