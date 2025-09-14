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

        return [
            'title' => $title,
            'url' => $this->faker->url(),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'news', true),
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