<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'course_teachers';

    public function course()
    {
        return $this->belongsTo('App\Models\course', 'course_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'user_id');
    }
}
