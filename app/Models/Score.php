<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_code', 'code');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code', 'code');
    }
}
