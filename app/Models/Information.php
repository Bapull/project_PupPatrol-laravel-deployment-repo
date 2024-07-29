<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'information_dog_name',
        'information_dog_character',
        'information_min_size',
        'information_max_size',
        'information_min_cost',
        'information_max_cost',
        'information_dog_text',
        'information_dog_geneticillness',
        'information_caution',
        'information_image_url'
    ];
}
