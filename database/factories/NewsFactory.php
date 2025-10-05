<?php

namespace Database\Factories;

use FEMR\Data\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        $title = $this->faker->sentence(5, true);
        $randomId = $this->faker->numberBetween(1, 1000);

        return [
            'title' => $title,
            'url' => 'https://example.com/news/' . Str::slug($title),
            'thumbnail' => "https://picsum.photos/seed/{$randomId}/640/480",
            'thumbnail_alt' => $this->faker->sentence(3),
            'is_featured' => $this->faker->boolean(20),
        ];
    }

    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
            ];
        });
    }
}