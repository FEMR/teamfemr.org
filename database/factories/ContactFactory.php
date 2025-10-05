<?php

namespace Database\Factories;

use FEMR\Data\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();

        return [
            'prefix' => $this->faker->optional(0.5, '')->randomElement(['Dr.', 'Mr.', 'Ms.', 'Mrs.', 'Prof.']),
            'first_name' => $firstName,
            'middle_name' => $this->faker->optional()->firstName(),
            'last_name' => $lastName,
            'suffix' => $this->faker->optional()->randomElement(['Jr.', 'Sr.', 'II', 'III', 'Ph.D.', 'M.D.']),
            'full_name' => $firstName . ' ' . $lastName,
            'title' => $this->faker->optional()->jobTitle(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}