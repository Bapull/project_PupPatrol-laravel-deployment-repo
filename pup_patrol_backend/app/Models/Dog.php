<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'birth_date',
        'owner_email',
        'photo_url',
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_email', 'email');
    }
}
