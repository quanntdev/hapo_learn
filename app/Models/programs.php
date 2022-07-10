<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programs extends Model
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

    public function lesson()
    {
        return $this->belongsTo('App\Models\lesson', 'lesson_id');
    }
}
