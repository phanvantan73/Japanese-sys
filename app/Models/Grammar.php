<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grammar extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'lesson_id',
		'content',
		'description',
	];

	public function lesson()
	{
		return $this->belongsTo(Lesson::class);
	}
}
