<?php

namespace Database\Factories;

use FEMR\Data\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolClassFactory extends Factory
{
    protected $model = SchoolClass::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Medicine',
                'Nursing',
                'Pharmacy',
                'Physical Therapy',
                'Occupational Therapy',
                'Physician Assistant',
                'Dentistry',
                'Veterinary Medicine',
                'Public Health',
                'Social Work'
            ]),
        ];
    }
}