<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
        'date_of_birth',
        'phone',
        'address',
        'avatar',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course', 'user_id', 'course_id');
    }

    public function coursesTeacher()
    {
        return $this->belongsToMany(Course::class, 'course_teacher', 'user_id', 'course_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_lesson', 'user_id', 'lesson_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function scopeTeachers($query)
    {
        return $query->where('role', config('roles.teacher'));
    }

    public function getDateOfBirthUpdatedAttribute()
    {
        return $this->attributes['date_of_birth'] ? date('d-m-Y', strtotime($this->attributes['date_of_birth'])) : config('user.not_update');
    }

    public function getPhoneUpdatedAttribute()
    {
        return $this->attributes['phone'] ? ($this->attributes['phone']) : config('user.not_update');
    }

    public function getAddressUpdatedAttribute()
    {
        return $this->attributes['address'] ? ($this->attributes['address']) : config('user.not_update');
    }
}
