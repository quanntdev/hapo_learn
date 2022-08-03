<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'star',
        'comment',
        'parent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function scopeMain($query)
    {
        return $query->limit(config('course.home_comment_number'));
    }

    public function scopeComments($query)
    {
        return $query->where('parent_id', '=', null)->orderBy('id', config('course.high_to_low'));
    }

    public function scopeReplies($query)
    {
        return $query->where('parent_id', '<>', null)->orderBy('id', config('course.high_to_low'));
    }
}
