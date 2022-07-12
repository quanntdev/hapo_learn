<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'type',
        'file',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'programs';

    public function lessons()
    {
        return $this->belongsTo(lesson::class, 'lesson_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_lessons', 'lesson_id', 'user_id');
    }
}