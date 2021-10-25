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

class TestController extends Controller
{
	public function index(){
		$data = Profile::join('kaderisasi', 'kaderisasi.id_user', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
		->join('postingan', 'postingan.id_user', '=', 'profile.id_user')
		->select('profile.nama_lengkap')
		->where('kaderisasi.komisariat', 2)
		->get();

		echo $data;
	}

	public function store(Request $request){
		$files = $request->file('pasFoto');
		dd($files->getClientOriginalName());
	}
}
