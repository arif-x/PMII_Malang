<?php

namespace App\Exports;

use App\Profile;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KaderExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
	use Exportable;

	public function columnFormats(): array
	{
		return [
			'O' => NumberFormat::FORMAT_TEXT,
			'P' => NumberFormat::FORMAT_TEXT
		];
	}

	public function view(): View
	{
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
		return view('admin.export-excel.export-kader', [        	
			'datas' => $data
		]);
	}
}
