<?php

namespace Database\Factories;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\VisitedLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitedLocationFactory extends Factory
{
    protected $model = VisitedLocation::class;

    public function definition()
    {
        return [
            'address' => $this->faker->streetAddress(),
            'address_ext' => $this->faker->optional()->secondaryAddress(),
            'locality' => $this->faker->city(),
            'administrative_area_level_1' => $this->faker->state(),
            'administrative_area_level_2' => $this->faker->optional(0.5, '')->city(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'start_date' => $this->faker->dateTimeBetween('-2 years', '+1 month'),
            'end_date' => $this->faker->optional()->dateTimeBetween('+1 month', '+6 months'),
        ];
    }

    public function withProgram(OutreachProgram $program)
    {
        return $this->state(function (array $attributes) use ($program) {
            return [
                'outreach_program_id' => $program->id,
            ];
        });
    }

    public function pastTrip()
    {
        return $this->state(function (array $attributes) {
            $startDate = $this->faker->dateTimeBetween('-2 years', '-1 month');
            return [
                'start_date' => $startDate,
                'end_date' => $this->faker->dateTimeBetween($startDate, '-1 week'),
            ];
        });
    }

    public function upcomingTrip()
    {
        return $this->state(function (array $attributes) {
            $startDate = $this->faker->dateTimeBetween('+1 week', '+6 months');
            return [
                'start_date' => $startDate,
                'end_date' => $this->faker->dateTimeBetween($startDate, '+1 year'),
            ];
        });
    }
}