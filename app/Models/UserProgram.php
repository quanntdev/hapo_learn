<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    use HasFactory;

    protected $table = 'user_program';

    protected $fillable = [
        'user_id',
        'program_id',
    ];

    public function scopeFinishedPrograms($query, $programs)
    {
        return $query->where('user_id', auth()->id())->whereIn('program_id', $programs->pluck('id')->toArray());
    }
}
