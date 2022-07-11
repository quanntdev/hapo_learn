<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'timestart',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'user_courses';

    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'user_id');
    }
}
