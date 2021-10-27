<?php

namespace App\Http\Controllers\AdminKomisariat\Postingan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;
use App\Provinsi;
use App\Rayon;
use App\Komisariat;
use App\Pekerjaan;
use App\Pendidikan;
use App\Kader;
use App\KaderisasiTerakhir;
use App\KoordinatUser;
use App\Postingan;

class FilterController extends Controller
{
	public function index(Request $request){
		if ($request->ajax()) {
			$data = Postingan::join('profile', 'profile.id_user', '=', 'postingan.id_user')
			->join('jenis_post', 'jenis_post.id_jenis_post', 'postingan.jenis_post')
			->join('kaderisasi', 'kaderisasi.id_user', '=', 'postingan.id_user')
			->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
			->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
			->select('postingan.*', 'profile.nama_lengkap', 'jenis_post.jenis_post as jenis', 'komisariat.nama_komisariat', 'rayon.nama_rayon', 'kaderisasi.komisariat', 'kaderisasi.rayon')
			->when(!empty($request->rayon), function($query) use ($request){
				$query->where('kaderisasi.rayon', $request->rayon);
			})			
			->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
			->get();	

			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('detail', function($row){

				$btn = '<a href="/admin-komisariat/postingan/detail/' . $row->id_post . '" data-toggle="tooltip"  data-id="'.$row->id_post.'" data-original-title="Edit" class="edit btn btn-primary btn-sm details">Detail</a>';

				return $btn;
			})
			->rawColumns(['detail'])
			->make(true);
		}

		$rayon = Rayon::join('kaderisasi', 'kaderisasi.rayon', '=', 'rayon.id_rayon')
		->where('rayon.id_rayon', DB::raw('(SELECT kaderisasi.rayon FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->pluck('rayon.nama_rayon', 'rayon.id_rayon');

		return view('komisariat.postingan-filter', compact('rayon'));
	}
}
