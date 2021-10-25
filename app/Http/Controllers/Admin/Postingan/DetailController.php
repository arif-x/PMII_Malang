<?php

namespace App\Http\Controllers\Admin\Postingan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postingan;

class DetailController extends Controller
{
    public function index($id){
    	$data = Postingan::where('id_post', $id)->get();
    	echo $data;
    }
}
