<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "postingan";
    protected $guarded = [];
    public $timestamps = false;
}
