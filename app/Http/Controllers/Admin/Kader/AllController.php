<?php

namespace App\Http\Controllers\Admin\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use App\Provinsi;
use App\Komisariat;
use App\Pekerjaan;
use App\Pendidikan;
use App\Kader;
use App\KaderisasiTerakhir;

class AllController extends Controller
{
	public function index(Request $request){
		if ($request->ajax()) {
			$data = Kader::join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
			->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
			->join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
			->select('profile.*', 'komisariat.nama_komisariat', 'pekerjaan.pekerjan', 'kaderisasi.tahun_bergabung')
			->get();

			// dd($data);
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('detail', function($row){

				$btn = '<a href="/admin/kader/detail/' . $row->id_user . '" data-toggle="tooltip"  data-id="'.$row->id_user.'" data-original-title="Edit" class="edit btn btn-primary btn-sm details">Detail</a>';

				return $btn;
			})
			->rawColumns(['detail'])
			->make(true);
		}

		$provinsi = Provinsi::pluck('name', 'id');
		$komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
		$pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
		$pendidikan = Pendidikan::pluck('pendidikan', 'id_pendidikan');
		$kaderisasi = KaderisasiTerakhir::pluck('kaderisasi_terakhir', 'id_kaderisasi_terakhir');
		$tahun = DB::table('kaderisasi')->groupBy('angkatan_ke')
        ->orderByRaw("cast(tahun_bergabung as unsigned) DESC")
        ->select('tahun_bergabung')
        ->pluck('tahun_bergabung', 'tahun_bergabung');

		return view('admin.kader', compact('provinsi', 'komisariat', 'pekerjaan', 'pendidikan', 'tahun', 'kaderisasi'));
	}

	// public function store(Request $request){
	// 	$check = Komisariat::where('id_komisariat', $request->kom_id)->first();
	// 	if(!$check){
	// 		Komisariat::create([
	// 			'nama_komisariat' => $request->nama
	// 		]);
	// 		return response()->json(['success'=>'Komisariat Disimpan.']);
	// 	} else {
	// 		Komisariat::where('id_komisariat', $request->kom_id)->update([
	// 			'nama_komisariat' => $request->nama
	// 		]);
	// 		return response()->json(['success'=>'Komisariat Diedit.']);
	// 	}
	// }

	public function edit($id){
		$data = Kader::join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('kaderisasi_terakhir', 'kaderisasi_terakhir.id_kaderisasi_terakhir', '=', 'kaderisasi.kaderisasi_terakhir')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
		->join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
		->join('wilayah_provinsi', 'wilayah_provinsi.id', 'profile.provinsi')
		->join('wilayah_kabupaten', 'wilayah_kabupaten.id', 'profile.kota_kabupaten')
		->join('wilayah_kecamatan', 'wilayah_kecamatan.id', 'profile.kecamatan')
		->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'profile.pendidikan_terakhir')
		->select('profile.*', 'komisariat.nama_komisariat', 'pekerjaan.pekerjan', 'kaderisasi.tahun_bergabung', 'wilayah_provinsi.name as nama_prov', 'wilayah_kabupaten.name as nama_kab', 'wilayah_kecamatan.name as nama_kec', 'pendidikan.pendidikan as nama_pendidikan', 'kaderisasi.tahun_bergabung', 'kaderisasi.angkatan_ke', 'kaderisasi_terakhir.kaderisasi_terakhir', 'rayon.nama_rayon')
		->where('profile.id_user', $id)
		->get();

		return response()->json($data);
	}

	// public function destroy($id){
	// 	Komisariat::where('id_komisariat', $id)->delete();
	// 	Rayon::where('id_komisariat', $id)->delete();
	// 	return response()->json(['success'=>'Komisariat Dihapus.']);
	// }

}
