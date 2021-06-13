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
        $this->assertCount(3,$attraction->photos);

    }

    public function testFindVideos()
    {
        $attractions = \App\Models\Attraction::all();
        $attraction = $attractions->first();

        $this->assertIsString($attraction->name);
        $this->assertCount(1,$attraction->videos);

    }
}