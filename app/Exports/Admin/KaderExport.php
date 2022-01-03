<?php

namespace App\Exports\Admin;

use App\Profile;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KaderExport implements FromView, ShouldAutoSize
{
	use Exportable;

	public function view(): View
	{
		$data = Profile::join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
		->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'profile.pendidikan_terakhir')
		->join('wilayah_provinsi', 'wilayah_provinsi.id', '=', 'profile.provinsi')
		->join('wilayah_kabupaten', 'wilayah_kabupaten.id', '=', 'profile.kota_kabupaten')
		->join('wilayah_kecamatan', 'wilayah_kecamatan.id', '=', 'profile.kecamatan')
		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
		->join('kaderisasi_terakhir', 'kaderisasi_terakhir.id_kaderisasi_terakhir', 'kaderisasi.kaderisasi_terakhir')
		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
		->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
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
			'kaderisasi.tahun_bergabung',
			'kaderisasi.angkatan_ke',
			'kaderisasi_terakhir.kaderisasi_terakhir',
			'komisariat.nama_komisariat',
			'rayon.nama_rayon'
		)->get();
		return view('admin.export-excel.export-kader', [        	
			'datas' => $data
		]);
	}
}

