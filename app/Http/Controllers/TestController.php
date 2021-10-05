<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;

class TestController extends Controller
{
    public function index(){
    	return view('test');
    }

    public function store(Request $request){
        $files = $request->file('pasFoto');
        dd($files->getClientOriginalName());
    }
}
