<?php

namespace Database\Factories;

use App\Models\Attraction;
use App\Models\VideoAttraction;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoAttractionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoAttraction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attraction = Attraction::all()->random(1);

        return [
            'name' => 'Video: ' . $this->faker->streetName,
            'url' => $this->faker->imageUrl(),
            'attraction_id' => $attraction[0]['id']
        ];
    }
}
