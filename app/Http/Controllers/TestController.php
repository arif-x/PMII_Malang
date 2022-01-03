<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Profile;
use App\Komisariat;
use App\Pekerjaan;
use App\Kader;
use App\Kaderisasi;
use App\Postingan;
use Carbon\Carbon;
use App\Rayon;
use App\KoordinatUser;
use App\Menu;

class TestController extends Controller
{
	public function index(){
		$data = env('APP_URL');

		echo $data;
	}

	public function store(Request $request){
		$files = $request->file('pasFoto');
		dd($files->getClientOriginalName());
	}
}
