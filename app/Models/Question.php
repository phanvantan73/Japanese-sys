<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'title',
    	'description',
    	'content',
    	'lesson_id',
    	'type',
    ];

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function instructions()
    {
    	return $this->hasMany(Instruction::class);
    }

    public function tests()
    {
    	return $this->belongsToMany(Test::class);
    }

    /**
     * Get the post's image.
     */
    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceable');
    }
}
