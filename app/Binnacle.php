<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
	protected $fillable = [
		'small_description',
		'description',
		'user_id',
		'action',
		'date',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}
}
