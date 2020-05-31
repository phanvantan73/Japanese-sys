<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'description',
    ];

    public function lessons()
    {
    	return $this->hasMany(Lesson::class);
    }
}
