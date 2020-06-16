<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'alphabet_id',
        'description',
    ];

    public function alphabet()
    {
        return $this->belongsTo(Alphabet::class);
    }

    public function getDescriptionAttribute()
    {
        return Storage::url($this->attributes['description']);
    }
}
