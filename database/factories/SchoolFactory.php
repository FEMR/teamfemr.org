<?php

namespace Database\Factories;

use FEMR\Data\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    protected $model = School::class;

    public function definition()
    {
        $name = $this->faker->words(3, true) . ' ' . $this->faker->randomElement(['University', 'College', 'School', 'Institute']);

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'has_trips' => $this->faker->boolean(70),
            'address' => $this->faker->streetAddress(),
            'address_ext' => $this->faker->optional()->secondaryAddress(),
            'locality' => $this->faker->city(),
            'administrative_area_level_1' => $this->faker->state(),
            'administrative_area_level_2' => $this->faker->optional()->city(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}