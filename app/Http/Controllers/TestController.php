<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;

class TestController extends Controller
{
    public function index(){
    	$myProv = Profile::where('id_user', Auth::user()->id)->value('provinsi');
    	echo $myProv;
    }

    public function store(Request $request){
        $files = $request->file('pasFoto');
        dd($files->getClientOriginalName());
    }
}
