<?php


namespace Tests\Feature\Models;


use Tests\TestCase;

class Attraction extends TestCase
{
    public function testFindPhotos()
    {
        $attractions = \App\Models\Attraction::all();
        $attraction = $attractions->first();

        $this->assertIsString($attraction->name);
        $this->assertCount(2,$attraction->photos);

    }
}