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

    public function course_teacher()
    {
        return $this->belongsTo('App\Models\course_teacher', 'user_id');
    }

    public function user_course()
    {
        return $this->belongsTo('App\Models\user_course', 'user_id');
    }

    public function user_lesson()
    {
        return $this->belongsTo('App\Models\user_lesson', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\comment', 'user_id');
    }
}
