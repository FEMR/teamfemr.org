<?php

namespace Database\Factories;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\Paper;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaperFactory extends Factory
{
    protected $model = Paper::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(3),
            'url' => $this->faker->url(),
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
}