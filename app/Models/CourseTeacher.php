<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTeacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course_teacher';

    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];
}
