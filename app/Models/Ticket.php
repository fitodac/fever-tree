<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{

  use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'name',
		'lastname',
		'email',
		'phone',
		'dni',
		'birthday',
		'ticket',
		'lang'
	];

	public function getNameAttribute($value){
		return ucwords($value);
	}

	public function getLastnameAttribute($value){
		return ucwords($value);
	}

	public function getDniAttribute($value){
		return strtoupper($value);
	}

}
