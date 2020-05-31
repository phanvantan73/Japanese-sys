<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'question_id',
    	'content',
    	'is_true',
    	'type',
    ];

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
