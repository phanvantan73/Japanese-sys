<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'course_id',
        'content',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function grammars()
    {
        return $this->hasMany(Grammar::class);
    }

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }

    /**
     * Get the post's image.
     */
    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceable');
    }
}
