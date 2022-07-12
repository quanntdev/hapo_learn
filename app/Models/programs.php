<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'programs';

    protected $fillable = [
        'lesson_id',
        'type',
        'file',
        'status',
    ];

    public function lesson()
    {
        return $this->belongsTo(lesson::class, 'lesson_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_lesson', 'lesson_id', 'user_id');
    }
}
