<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const ADMIN = 'admin';
    const USER = 'user';

    protected $fillable = [
    	'name',
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class)->withTimestamps();
    }
}
