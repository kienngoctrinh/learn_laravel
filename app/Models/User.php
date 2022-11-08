<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function getAgeAttribute()
    {
        return date_diff(date_create($this->birthday), date_create())->y;
    }

    public function getDateAttribute()
    {
        return date('Y-m-d', strtotime($this->birthday));
    }

    protected $fillable = [
        'code',
        'email',
        'name',
        'birthday',
        'gender',
        'password',
        'role',
        'avatar',
    ];
}