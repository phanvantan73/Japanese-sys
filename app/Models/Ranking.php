<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ranking extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id',
    	'description',
    	'score',
    	'time',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
