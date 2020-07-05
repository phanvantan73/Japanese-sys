<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id',
    ];

    public function questions()
    {
    	return $this->belongsToMany(Question::class);
    }

    public function result()
    {
    	return $this->hasOne(Result::class);
    }
}
