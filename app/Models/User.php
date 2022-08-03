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

    public function scopeUpAvatar($query, $avatar, $id)
    {

        $oldAvatar = $this->find($id)->avatar;
        if ($oldAvatar != null) {
            unlink(public_path('public/profile/' . $oldAvatar));
        }

        $get_image = $avatar;
        $path =   'public/profile/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $data = [
            'avatar' => $new_image,
        ];

        $user = User::find($id);
        $user->update($data);
    }

    public function getCheckAvatarAttribute()
    {
        $avatar = $this->avatar;
        if ($avatar == null) {
            return asset('images/guest-user.png');
        } else {
            return asset('public/profile/' . $avatar);
        }
    }
}
