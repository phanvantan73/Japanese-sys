<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'test_id',
    	'log',
    	'score',
    	'time_answer',
    ];

    public function test()
    {
    	return $this->belongsTo(Test::class);
    }
}
