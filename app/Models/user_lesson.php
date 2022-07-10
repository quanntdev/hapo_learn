<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'user_lessons';

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\lesson', 'lesson_id');
    }
}
