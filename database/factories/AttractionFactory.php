<?php

namespace Database\Factories;

use App\Models\Attraction;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttractionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attraction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'coordinates' => '{"lat": '.$this->faker->latitude.', "lng": '.$this->faker->longitude.'}'
        ];
    }
}
