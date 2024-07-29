<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $textArray = [
        "근력이 강한 편이신가요?",
        "방이 지저분하면 스트레스를 많이 받는 편인가요?",
        "평소 달리기나 산책을 좋아하시나요?",
        "훈련에 많은 시간을 쓰실 수 있나요?",
        "집에 다양한 사람들이 찾아오나요?",
        "가구는 비싼 걸 써야한다고 생각하나요?",
        "지인이 아프면 걱정돼서 아무것도 못 하나요?",
        "집에 자주 못 들어 올 수도 있나요?"
    ];
    public $variable = [
        'answerIsBig',
        'answerIsFluff',
        'answerIsWalking',
        'answerIsSmart',
        'answerIsShyness',
        'answerIsBiting',
        'answerIsNuisance',
        'answerIsIndependent',
    ];
    public $index = 0;
    public function definition(): array
    {
        $question = $this->textArray[$this->index];
        $name = $this->variable[$this->index];
        $this->index++;
        return [
            'question_text' => $question,
            'question_variable' => $name,
        ];
    }
}
