<?php

namespace Database\Factories;

use FEMR\Data\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4, true),
            'description' => $this->faker->paragraph(2),
            'file' => 'publications/' . $this->faker->slug() . '.pdf',
        ];
    }
}