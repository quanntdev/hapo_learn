<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tag_name',
        'slug_tag',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'tags';

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_tag', 'tag_id', 'course_id');
    }
}
