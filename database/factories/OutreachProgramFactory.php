<?php

namespace Database\Factories;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OutreachProgramFactory extends Factory
{
    protected $model = OutreachProgram::class;

    public function definition()
    {
        $name = $this->faker->words(3, true) . ' Outreach Program';
        $months = $this->faker->randomElements(
            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            $this->faker->numberBetween(1, 6)
        );

        return [
            'name' => $name,
            'school_name' => $this->faker->words(2, true) . ' ' . $this->faker->randomElement(['University', 'College', 'Medical School']),
            'slug' => Str::slug($name),
            'year_initiated' => $this->faker->year('-10 years'),
            'yearly_outreach_participants' => $this->faker->numberBetween(10, 100),
            'matriculants_per_class' => $this->faker->numberBetween(50, 200),
            'months_of_travel' => implode(',', $months),
            'uses_emr' => $this->faker->boolean(70),
            'comments' => $this->faker->optional(0.5, '')->paragraph(),
        ];
    }

    public function approved()
    {
        return $this->afterCreating(function (OutreachProgram $program) {
            $program->update([
                'approved_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'approved_by' => User::factory()->create()->id,
            ]);
        });
    }

    public function pending()
    {
        return $this->afterCreating(function (OutreachProgram $program) {
            $program->update([
                'approved_at' => null,
                'approved_by' => null,
            ]);
        });
    }
}