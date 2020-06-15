<?php

namespace App\Models;

use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'target_id',
    	'target_type',
    	'path',
    ];

    /**
     * Get all of the owning imageable models.
     */
    public function resourceable()
    {
        return $this->morphTo();
    }

    public function getPathAttribute()
    {
        return Storage::url($this->attributes['path']);
    }
}
