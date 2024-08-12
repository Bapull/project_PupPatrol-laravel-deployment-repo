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
            'name' => 'puppy',
            'breed' => 'golden retriever',
            'birth_date' => '2024-08-01',
            'owner_email' => 'bapull@member.com',
            'photo_url' => 'pup-patrol-user-dog/golden.jpg'
        ];
    }
}
