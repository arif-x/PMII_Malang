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
use App\KoordinatUser;

class TestController extends Controller
{
	public function index(){
		$data = Kader::join('wilayah_kabupaten', 'wilayah_kabupaten.id', '=', 'profile.kota_kabupaten')
		->groupBy('wilayah_kabupaten.id')
		->select('wilayah_kabupaten.name', DB::raw('COUNT(wilayah_kabupaten.name) as jumlah_kabupaten', 'wilayah_kabupaten.name'))
		->get('wilayah_kabupaten.name', 'jumlah_kabupaten');

		echo $data;
	}

	public function store(Request $request){
		$files = $request->file('pasFoto');
		dd($files->getClientOriginalName());
	}
}
