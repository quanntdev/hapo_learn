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
        return $this->belongsToMany(course_tag::class, 'course_id');
    }

    public function lesson()
    {
        return $this->hasMany(lesson::class, 'course_id');
    }

    public function user_course()
    {
        return $this->belongsToMany(user_course::class, 'course_id');
    }

    public function course_teacher()
    {
        return $this->belongsToMany(course_teacher::class, 'course_id');
    }

    public function comments()
    {
        return $this->hasMany(comment::class, 'course_id');
    }
}
