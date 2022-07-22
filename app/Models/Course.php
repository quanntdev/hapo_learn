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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag', 'course_id', 'tag_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course', 'course_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'course_id');
    }

    public function scopeMain($query)
    {
        return $query->limit(config('course.home_course_number'))->orderBy('id', config('course.sort_from_high_to_low'));
    }

    public function scopeOther($query)
    {
        return $query->inRandomOrder()->take(config('course.home_course_number_random'));
    }
}
