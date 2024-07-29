<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $bool = [true, false];
    public function definition(): array
    {
        $big = array_rand($this->bool);
        $fluff = array_rand($this->bool);
        $walking = array_rand($this->bool);
        $smart = array_rand($this->bool);
        $shyness = array_rand($this->bool);
        $biting = array_rand($this->bool);
        $nuisance = array_rand($this->bool);
        $independent = array_rand($this->bool);
        return [
            'answer_is_big' => $big,
            'answer_is_fluff' => $fluff,
            'answer_is_walking' => $walking,
            'answer_is_smart' => $smart,
            'answer_is_shyness' => $shyness,
            'answer_is_biting' => $biting,
            'answer_is_nuisance' => $nuisance,
            'answer_is_independent' => $independent,
        ];
    }
}
