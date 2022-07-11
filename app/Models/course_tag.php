<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'tag_id',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'course_tags';

    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }

    public function tag()
    {
        return $this->belongsTo(tag::class, 'tag_id');
    }
}
