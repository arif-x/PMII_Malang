<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminKomisariat extends Model
{
    protected $table = "users";
    protected $fillable = ['level'];
}
