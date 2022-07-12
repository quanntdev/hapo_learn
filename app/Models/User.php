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
        'name',
        'email',
        'password',
        'role',
        'd_o_b',
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

    protected $primaryKey = 'id';

    protected $table = 'users';

    public function courseUsers()
    {
        return $this->belongsToMany(Course::class, 'user_id', 'user_id', 'course_id');
    }

    public function courseTeacher()
    {
        return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'user_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_lessons', 'user_id', 'lesson_id');
    }

    public function comments()
    {
        return $this->hasMany(comment::class, 'user_id');
    }
}
