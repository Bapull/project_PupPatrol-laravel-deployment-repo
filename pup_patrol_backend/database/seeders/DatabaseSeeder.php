<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'bapull',
            'email' => 'bapull@member.com',
            'role' => 'admin',
            'profile_picture' => '밥풀프로필.jpg',
            'birthday' => '2024-09-07'
        ]);
        
        $this->call(AnswerSeeder::class);
        $this->call(InformationSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(DogSeeder::class);
    }
}
