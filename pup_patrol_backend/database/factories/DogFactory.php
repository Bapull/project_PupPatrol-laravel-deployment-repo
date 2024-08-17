<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'dog_name' => 'puppy',
            'dog_breed' => 'golden retriever',
            'dog_birth_date' => '2024-08-01',
            'dog_owner_email' => 'bapull@member.com',
            'dog_photo_url' => '1723735002_golden.jpg'
        ];
    }
}
