<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Information;
use App\Models\Question;
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

        $this->call(AnswerSeeder::class);
        $this->call(InformationSeeder::class);
        $this->call(QuestionSeeder::class);

    }
}
