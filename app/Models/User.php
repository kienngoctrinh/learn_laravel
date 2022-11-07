<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function getGenderNameAttribute()
    {
        return ($this->gender === 0) ? 'Female' : 'Male';
    }

    public function getAgeAttribute()
    {
        return date_diff(date_create($this->birthday), date_create())->y;
    }

    protected $fillable = [
        'email',
        'name',
        'birthday',
        'gender',
        'programming_language',
    ];
}