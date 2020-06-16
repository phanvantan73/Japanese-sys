<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alphabet extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'content',
    	'type',
    ];

    /**
     * Get the alphabet's image.
     */
    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceable');
    }

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }
}
