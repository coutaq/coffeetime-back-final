<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Place;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'photo' => $this->faker->regexify('[A-Za-z0-9]{150}'),
            'description' => $this->faker->text,
            'lat' => $this->faker->latitude,
            'lon' => $this->faker->regexify('[A-Za-z0-9]{150}'),
        ];
    }
}
