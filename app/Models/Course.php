<?php

namespace App\Models;

use Illuminate\Contracts\Pipeline\Hub;
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
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    public function getIsFinishedAttribute()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id())->where('user_course.status', '=', config('course.end_course'));
        })->exists();
    }

    public function getIsnotFinishedAttribute()
    {
        return $this->users()->whereExists(function ($query) {
            $query->where('user_id', auth()->id())->where('user_course.status', '=', config('course.onstatus'));
        })->count();
    }

    public function getRatesAttribute()
    {
        return round(($this->comments()->comments()->sum('star'))/($this->comments()->where('star', '>', 0)->comments()->count()));
    }

    public function getCountRatesAttribute()
    {
        return $this->comments()->where('star', '>', 0)->comments()->count();
    }

    public function getCountRates5Attribute()
    {
        return $this->comments()->where('star', '=', 5)->comments()->count();
    }

    public function getCountRates4Attribute()
    {
        return $this->comments()->where('star', '=', 4)->comments()->count();
    }

    public function getCountRates3Attribute()
    {
        return $this->comments()->where('star', '=', 3)->comments()->count();
    }

    public function getCountRates2Attribute()
    {
        return $this->comments()->where('star', '=', 2)->comments()->count();
    }

    public function getCountRates1Attribute()
    {
        return $this->comments()->where('star', '=', 1)->comments()->count();
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
        $time = $this->lessons()->sum('time_lesson');
        $second = $time % config('course.change_time');
        $minute = (($time - $second) / config('course.change_time')) % config('course.change_time');
        $hour = ($time - $second - $minute * config('course.change_time')) / (config('course.change_time') * config('course.change_time'));
        return round(($hour * config('course.times') + $minute * config('course.sec') + $second) / config('course.times'));

    }

    public function getPricesAttribute()
    {
        return $this->price == 0 ? ': ' . __('course-detail.free') : ': ' . $this->price . __('course-detail.price_value');
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
}
