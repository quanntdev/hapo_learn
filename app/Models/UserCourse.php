<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_course';

    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];

    public function scopeJoinNum($query)
    {
        return $query->select('user_id')->groupBy('user_id')->get()->count();
    }
}
