<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vocabulary extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'content',
    	'description',
    	'lesson_id',
    ];

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
}
