<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name',
        'slug_tag',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $table = 'tags';

    public function course_tag()
    {
        return $this->belongsToMany(course_tag::class, 'tag_id');
    }
}
