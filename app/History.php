<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
	protected $table = 'postingan';
	protected $guarded = [];
	public $timestamps = false;
}
