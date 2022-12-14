<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'user_code',
        'course_code',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_code', 'code');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code', 'code');
    }
}
