<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'dog_name',
        'dog_breed',
        'dog_birth_date',
        'dog_owner_email',
        'dog_photo_name',
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'dog_owner_email', 'email');
    }
}
