<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_name',
        'slug_course',
        'image',
        'description',
        'price',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'courses';

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'course_tags','course_id','tag_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function userCourse()
    {
        return $this->belongsToMany(User::class, 'user_courses', 'course_id', 'user_id');
    }

    public function courseTeacher()
    {
        return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'user_id');
    }

    public function Comment()
    {
        return $this->hasMany(comment::class, 'course_id');
    }
}
