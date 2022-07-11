<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'star',
        'comment',
        'parent_id',
    ];

    protected $primaryKey = 'id';

    protected $table = 'comments';

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }
}
