<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;

class TestController extends Controller
{
    public function index(){
    	$nik = Profile::where('id_user', Auth::user()->id)->pluck('nik');
    	$nim = Profile::where('id_user', Auth::user()->id)->pluck('nim');
    	if(
    		Profile::where('id_user', Auth::user()->id)->pluck('nik') == '[null]' || Profile::where('id_user', Auth::user()->id)->pluck('nim') == '[null]' 
    	){
    		echo 'tak ada';
    	} else {
    		echo 'ada';
    	}
    }
}
