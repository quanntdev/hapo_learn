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

    public function comments()
    {
        return $this->hasMany(Comment::class, 'course_id');
    }

    public function scopeMain($query)
    {
        return $query->limit(config('course.home_course_number'))->orderBy('id', config('course.sort_high_to_low'));
    }

    public function scopeOther($query)
    {
        return $query->inRandomOrder()->take(config('course.other_course_order'));
    }

    public function scopeAddLessonTime($query, $db)
    {
        $db->map(function ($dbFunction) {
            $dbFunction->timeLesson = Lesson::where('course_id', $dbFunction->id)->pluck('time_lesson')->map(function ($time) {
                return Lesson::timeToMinutes($time);
            })->sum();
            return $dbFunction;
        });
    }

    public function getCourseSerch($key) // phần này dùng làm ajax search
    {
        $courses = Course::getAllCourse()->where('course_name', 'like', '%' . $key . '%')->get();
        Course::addLessonTime($courses);
        return $courses;
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


    public function scopeOutputSearchData($query, $keyword) // dùng in ra dữ liệu ajax search
    {
        $output = '';
        $data = Course::getCourseSerch($keyword);
        if ($data->count() == 0) {
            $output .= '<div class="no-course">
                <div class="no-course-icon"><i class="fa-solid fa-sad-tear"></i></div>
                <div class="no-course-text">' .__('all-course.no_course'). ' "' .$keyword. '"</div>
                </div>';

                return Response($output);
        } else {
        foreach ($data as $key => $value) {
            $output .= '
                <div class="item float-start">
                    <div class="course-content">
                        <div class="row">
                            <div class="col-2">
                                <img src=" ' .$value->image. ' " alt="" class="img-course">
                            </div>
                            <div class="col-10">
                                <div class="title">
                                    ' .$value->course_name. '
                                </div>
                                <div class="content">
                                    ' .$value->description. '
                                </div>
                                <div class="btn-learn">
                                    <a href="">More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-statics">
                        <div class="course-statics-items">
                            <div class="title">
                                Learners
                            </div>
                        <div class="statics">
                                ' .$value->users_count. '
                        </div>
                        </div>
                        <div class="course-statics-items">
                            <div class="title">
                                Lessons
                            </div>
                             <div class="statics">
                                ' .$value->lessons_count. '
                            </div>
                        </div>
                        <div class="course-statics-items">
                            <div class="title">
                                Times
                            </div>
                            <div class="statics">
                                ' .$value->timeLesson . ' ' .__('all-course.hour'). '
                            </div>
                        </div>
                    </div>
                </div>';
            }
        return Response($output);
        }
    }

    public function scopeFilter($query, $data)
    {
        if (!empty($data['submit'])) {
            if (!empty($data['keyword'])) {
                $query->where('course_name', 'LIKE', "%{$data['keyword']}%");
            }

            if (!empty($data['numberStudent'])) {
                $query->withCount('users')->orderBy('users_count', $data['numberStudent']);
            }

            if (!empty($data['timeCourse'])) {
                $query->withSum('lessons','time_lesson')->orderBy('lessons_sum_time_lesson', $data['timeCourse']);
            }

            if (!empty($data['lesson'])) {
                $query->withCount('lessons')->orderBy('lessons_count', $data['lesson']);
            }

            if (!empty($data['comment'])) {
                $query->withCount('comments')->orderBy('comments_count', $data['comment']);
            }

            if (!empty($data['tags'])) {
                $idCourse = CourseTag::where('tag_id', $data['tags'])->pluck('course_id');
                $query->whereIn('id', $idCourse);
            }

            if (!empty($data['teacher'])) {
                $idCourse = CourseTeacher::where('user_id', $data['teacher'])->pluck('course_id');
                $query->whereIn('id', $idCourse);
            }

            if (!empty($data['lastest'])) {
                $query->orderBy('created_at', $data['lastest']);
            }
        }
        $query = $query->paginate(config('all-course.number_paginate'))->appends(request()->query());
        Course::addLessonTime($query);
        return $query;
    }
}
