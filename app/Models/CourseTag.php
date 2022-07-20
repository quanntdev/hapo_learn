<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course_tag';

    protected $fillable = [
        'course_id',
        'tag_id',
        'status',
    ];

    public function scopeGetCourse($query, $tagId)
    {
        return $query->select('course_id')->groupBy('course_id')->where('tag_id', $tagId)->get();
    }
}
