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
		$data = Profile::join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
		->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'profile.pendidikan_terakhir')
		->join('wilayah_provinsi', 'wilayah_provinsi.id', '=', 'profile.provinsi')
		->join('wilayah_kabupaten', 'wilayah_kabupaten.id', '=', 'profile.kota_kabupaten')
		->join('wilayah_kecamatan', 'wilayah_kecamatan.id', '=', 'profile.kecamatan')
		->select(
			'profile.*', 
			'pekerjaan.id_pekerjan as id_kerja',
			'pekerjaan.pekerjan as nama_kerja',      
			'pendidikan.pendidikan as nama_pendidikan',
			'wilayah_provinsi.id as prov_id',
			'wilayah_provinsi.name as nama_prov',
			'wilayah_kabupaten.id as kab_id',
			'wilayah_kabupaten.name as nama_kab',
			'wilayah_kecamatan.id as kec_id',
			'wilayah_kecamatan.name as nama_kec',
		)->get();

		echo $data;
	}

	public function store(Request $request){
		$files = $request->file('pasFoto');
		dd($files->getClientOriginalName());
	}
}
