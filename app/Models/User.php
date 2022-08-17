<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
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

    public function getCheckAvatarAttribute()
    {
        $avatar = $this->avatar;
        if ($avatar == null) {
            return asset('images/guest-user.png');
        } else {
            return asset($avatar);
        }
    }

    public function getRolesAttribute()
    {
        $roles = $this->role;
        switch ($roles) {
            case config('roles.normal_user'):
                return [
                    'roles' => __('roles.normal_user'),
                    'color' => __('roles.color_normal_user'),
                ];
                break;
            case config('roles.teacher'):
                return [
                    'roles' => __('roles.teacher'),
                    'color' => __('roles.color_teacher'),
                ];
                break;
            default:
                return [
                    'roles' => __('roles.admin'),
                    'color' => __('roles.color_admin'),
                ];
                break;
        }
    }

    public function getTimeCreateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }
}
