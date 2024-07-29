<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        "answer_is_big",
        "answer_is_fluff",
        "answer_is_walking",
        "answer_is_smart",
        "answer_is_shyness",
        "answer_is_biting",
        "answer_is_nuisance",
        "answer_is_independent",
    ];
}
