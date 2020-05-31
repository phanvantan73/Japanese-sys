<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instruction extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'question_id',
    	'content',
    ];

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
