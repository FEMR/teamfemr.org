<?php

namespace Database\Factories;

use FEMR\Data\Models\PartnerOrganization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartnerOrganizationFactory extends Factory
{
    protected $model = PartnerOrganization::class;

    public function definition()
    {
        $name = $this->faker->words(2, true) . ' ' . $this->faker->randomElement(['Foundation', 'Organization', 'Association', 'Institute', 'Society']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'website' => $this->faker->url(),
        ];
    }
}