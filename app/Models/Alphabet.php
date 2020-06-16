<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alphabet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
        'type',
        'image',
        'audio',
    ];

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }

    public function getImageAttribute()
    {
        return Storage::url($this->attributes['image']);
    }

    public function getAudioAttribute()
    {
        return Storage::url($this->attributes['audio']);
    }
}
