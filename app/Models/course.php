<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

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

    public function course_tag()
    {
        return $this->hasMany('App\Models\course_tag', 'course_id');
    }

    public function lesson()
    {
        return $this->hasMany('App\Models\lesson', 'course_id');
    }

    public function user_course()
    {
        return $this->hasMany('App\Models\user_course', 'course_id');
    }

    public function course_teacher()
    {
        return $this->hasMany('App\Models\course_teacher', 'course_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\comment', 'course_id');
    }
}
