<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = "postingan";
    protected $guarded = [];
    public $timestamps = false;
}
