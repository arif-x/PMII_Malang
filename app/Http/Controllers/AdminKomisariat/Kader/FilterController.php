<?php

namespace App\Http\Controllers\AdminKomisariat\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;
use App\Provinsi;
use App\Komisariat;
use App\Pekerjaan;
use App\Pendidikan;
use App\Kader;
use App\KaderisasiTerakhir;
use App\KoordinatUser;
use App\Rayon;

class FilterController extends Controller
{
	public function index(Request $request){
		if ($request->ajax()) {
			$data = Kader::join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
			->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
			->join('kaderisasi_terakhir', 'kaderisasi_terakhir.id_kaderisasi_terakhir', '=', 'kaderisasi.kaderisasi_terakhir')
			->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
			->join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
			->join('users', 'users.id', '=', 'profile.id_user')
			->where('users.status_profile', 3)
			->select('profile.*', 'rayon.nama_rayon', 'pekerjaan.pekerjan', 'kaderisasi.tahun_bergabung')
			->when(!empty($request->provinsi), function($query) use ($request){
				$query->where('profile.provinsi', $request->provinsi);
			})
			->when(!empty($request->kabupaten), function($query) use ($request){
				$query->where('profile.kota_kabupaten', $request->kabupaten);
			})
			->when(!empty($request->kecamatan), function($query) use ($request){
				$query->where('profile.kecamatan', $request->kecamatan);
			})
			->when(!empty($request->statusKawin), function($query) use ($request){
				$query->where('profile.status_pernikahan', $request->statusKawin);
			})
			->when(!empty($request->pendidikan), function($query) use ($request){
				$query->where('profile.pendidikan_terakhir', $request->pendidikan);
			})
			->when(!empty($request->pekerjaan), function($query) use ($request){
				$query->where('profile.pekerjaan', $request->pekerjaan);
			})
			->when(!empty($request->rayonPenyelenggara), function($query) use ($request){
				$query->where('kaderisasi.rayon', $request->rayonPenyelenggara);
			})
			->when(!empty($request->kaderisasi), function($query) use ($request){
				$query->where('kaderisasi.kaderisasi_terakhir', $request->kaderisasi);
			})
			->when(!empty($request->tanggalLahirMulai), function($query) use ($request){
				$query->whereRaw("STR_TO_DATE(tanggal_lahir, '%d/%m/%Y') >= STR_TO_DATE('" . Carbon::parse($request->tanggalLahirMulai)->format('d/m/Y') . "', '%d/%m/%Y')");
			})
			->when(!empty($request->tanggalLahirAkhir), function($query) use ($request){
				$query->whereRaw("STR_TO_DATE(tanggal_lahir, '%d/%m/%Y') <= STR_TO_DATE('" . Carbon::parse($request->tanggalLahirAkhir)->format('d/m/Y') . "', '%d/%m/%Y')");
			})
			->when(!empty($request->tahun), function($query) use ($request){
				$query->where('kaderisasi.tahun_bergabung', $request->tahun);	
			})
			->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
			->get();		

			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('detail', function($row){

				$btn = '<a href="/admin-komisariat/kader/detail/' . $row->id_user . '" data-toggle="tooltip"  data-id="'.$row->id_user.'" data-original-title="Edit" class="edit btn btn-primary btn-sm details">Detail</a>';

				return $btn;
			})
			->rawColumns(['detail'])
			->make(true);
		}

		$provinsi = Provinsi::pluck('name', 'id');
		$rayon = Rayon::join('kaderisasi', 'kaderisasi.rayon', '=', 'rayon.id_rayon')
		->where('rayon.id_rayon', DB::raw('(SELECT kaderisasi.rayon FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->pluck('rayon.nama_rayon', 'rayon.id_rayon');
		$pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
		$pendidikan = Pendidikan::pluck('pendidikan', 'id_pendidikan');		
		$kaderisasi = KaderisasiTerakhir::pluck('kaderisasi_terakhir', 'id_kaderisasi_terakhir');
		$tahun = DB::table('kaderisasi')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->groupBy('angkatan_ke')
		->orderByRaw("cast(tahun_bergabung as unsigned) DESC")
		->select('tahun_bergabung')
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->pluck('tahun_bergabung', 'tahun_bergabung');

		$kaders = Kader::join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->join('kaderisasi_terakhir', 'kaderisasi_terakhir.id_kaderisasi_terakhir', '=', 'kaderisasi.kaderisasi_terakhir')
		->groupBy('kaderisasi_terakhir.kaderisasi_terakhir')
		->select('kaderisasi_terakhir.kaderisasi_terakhir', DB::raw('COUNT(kaderisasi_terakhir.kaderisasi_terakhir) as jumlah_kaderisasi', 'kaderisasi_terakhir.kaderisasi_terakhir'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$pendidikans = Kader::join('pendidikan', 'pendidikan.id_pendidikan', '=', 'profile.pendidikan_terakhir')
		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->groupBy('pendidikan.pendidikan')
		->select('pendidikan.pendidikan', DB::raw('COUNT(pendidikan.pendidikan) as jumlah_pendidikan', 'pendidikan.pendidikan'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$pekerjaans = Kader::join('pekerjaan', 'id_pekerjan', '=', 'profile.pekerjaan')
		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->groupBy('pekerjaan.pekerjan')
		->select('pekerjaan.pekerjan as kerja', DB::raw('COUNT(pekerjaan.pekerjan) as jumlah_pekerjaan', 'pekerjaan.pekerjan'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$komisariats = Kader::join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->groupBy('komisariat.nama_komisariat')
		->select('komisariat.nama_komisariat', DB::raw('COUNT(komisariat.nama_komisariat) as jumlah_komisariat', 'komisariat.nama_komisariat'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$rayons = Kader::join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
		->groupBy('rayon.nama_rayon')
		->select('rayon.nama_rayon', DB::raw('COUNT(rayon.nama_rayon) as jumlah_rayon', 'rayon.nama_rayon'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$provinsis = Kader::join('wilayah_provinsi', 'wilayah_provinsi.id', '=', 'profile.provinsi')
		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->groupBy('wilayah_provinsi.id')
		->select('wilayah_provinsi.name', DB::raw('COUNT(wilayah_provinsi.name) as jumlah_provinsi', 'wilayah_provinsi.name'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$kabupatens = Kader::join('wilayah_kabupaten', 'wilayah_kabupaten.id', '=', 'profile.kota_kabupaten')
		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->groupBy('wilayah_kabupaten.id')
		->select('wilayah_kabupaten.name', DB::raw('COUNT(wilayah_kabupaten.name) as jumlah_kabupaten', 'wilayah_kabupaten.name'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		$koordinats = KoordinatUser::join('profile', 'profile.id_user', '=', 'koordinat_user.id_user')
		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->join("wilayah_kabupaten","wilayah_kabupaten.id", "=", "profile.kota_kabupaten")
		->groupBy('koordinat_user.lat', 'koordinat_user.lng')
		->select('koordinat_user.lat', 'koordinat_user.lng', 'wilayah_kabupaten.name as kab',  DB::raw('COUNT(koordinat_user.id_user) as jml', 'profile.nama_lengkap'), DB::raw('GROUP_CONCAT(profile.nama_lengkap SEPARATOR ",") as nama'))
		->where('komisariat.id_komisariat', DB::raw('(SELECT kaderisasi.komisariat FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->get();

		return view('komisariat.kader-filter', compact('provinsi', 'rayon', 'pekerjaan', 'pendidikan', 'tahun', 'kaderisasi'), [
			'koordinats' => $koordinats,
			'kaders' => $kaders,
			'pendidikans' => $pendidikans,
			'pekerjaans' => $pekerjaans,
			'komisariats' => $komisariats,
			'rayons' => $rayons,
			'provinsis' => $provinsis,
			'kabupatens' => $kabupatens
		]);
	}
}
