<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Ramsey\Collection\Collection;

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

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'course_id');
    }

    public function scopeMain($query)
    {
        return $query->limit(config('course.home_course_number'))->orderBy('id', config('course.high_to_low'));
    }

    public function scopeOther($query)
    {
        return $query->inRandomOrder()->take(config('course.other_course_order'));
    }

    public function getIsJoinedAttribute()
    {
        if (auth()->check() && $this->users()->where('user_id', auth()->user()->id)->count() > 0) {
            return true;
        }
        return false;
    }

    public function getIsFinishedAttribute()
    {
        return $this->users()->where('user_id', auth()->user()->id)->where('user_course.status', '=', config('course.end_course'))->count();
    }

    public function getRatesAttribute()
    {
        return $this->comments()->where('parent_id', '=', null)->sum('star');
    }

    public function getCountRatesAttribute()
    {
        return $this->comments()->where('star', '>', 0)->where('parent_id', '=', null)->count();
    }

    public function getCountRates5Attribute()
    {
        return $this->comments()->where('star', '=', 5)->where('parent_id', '=', null)->count();
    }

    public function getCountRates4Attribute()
    {
        return $this->comments()->where('star', '=', 4)->where('parent_id', '=', null)->count();
    }

    public function getCountRates3Attribute()
    {
        return $this->comments()->where('star', '=', 3)->where('parent_id', '=', null)->count();
    }

    public function getCountRates2Attribute()
    {
        return $this->comments()->where('star', '=', 2)->where('parent_id', '=', null)->count();
    }

    public function getCountRates1Attribute()
    {
        return $this->comments()->where('star', '=', 1)->where('parent_id', '=', null)->count();
    }

    public function getLearnersAttribute()
    {
        return $this->users()->count();
    }

    public function getLessonsAttribute()
    {
        return $this->lessons()->count();
    }

    public function getTimesAttribute()
    {
        return $this->lessons()->sum('time_lesson');
    }

    public function scopeFilter($query, $data)
    {
        if (!empty($data['keyword'])) {
            $query->where('course_name', 'LIKE', "%{$data['keyword']}%")
                ->orWhere('description', 'LIKE', "%{$data['keyword']}%");
        }

        if (!empty($data['learners'])) {
            $query->withCount('users')->orderBy('users_count', $data['learners']);
        }

        if (!empty($data['time'])) {
            $query->withSum('lessons', 'time_lesson')->orderBy('lessons_sum_time_lesson', $data['time']);
        }

        if (!empty($data['lesson'])) {
            $query->withCount('lessons')->orderBy('lessons_count', $data['lesson']);
        }

        if (!empty($data['comment'])) {
            $query->withCount('comments')->orderBy('comments_count', $data['comment']);
        }

        if (!empty($data['tags'])) {
            $query->whereHas('tags', function ($query) use ($data) {
                $query->whereIn('tag_id', $data['tags']);
            });
        }

        if (!empty($data['teacher'])) {
            $query->whereHas('teachers', function ($query) use ($data) {
                $query->whereIn('user_id', $data['teacher']);
            });
        }

        if (!empty($data['created_time'])) {
            $query->orderBy('created_at', $data['created_time']);
        }

        return $query;
    }

    public function scopeGetCourseId($query, $slug)
    {
        return $query->where('slug_course', $slug)->first()->id;
    }

    public function scopeOtherCourseDetail($query)
    {
        return $query->inRandomOrder()->take(config('course.other_course_on_detail'));
    }
}
