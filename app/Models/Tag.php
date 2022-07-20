<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tag_name',
        'slug_tag',
        'status',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_tag', 'tag_id', 'course_id');
    }

    public function scopegetTag($query)
    {
        return $query->where('status', config('tag.status'))->orderBy('id', config('course.sort_high_to_low'))->get();
    }
}
