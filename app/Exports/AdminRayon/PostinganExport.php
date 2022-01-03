<?php

namespace App\Exports\AdminRayon;

use App\Postingan;
use App\Kaderisasi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PostinganExport implements FromView, ShouldAutoSize
{
	use Exportable;

	public function view(): View
	{
		$idRayonAdmin = Kaderisasi::where('id_user', Auth::user()->id)->value('rayon');

		$data = Postingan::join('profile', 'profile.id_user', '=', 'postingan.id_user')
		->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
		->join('kaderiasi.id_user', '=', 'profile.id_user')
		->select('jenis_post.jenis_post as kategori', 'profile.nama_lengkap', 'postingan.*')
		->where('kaderiasi.rayon', $idRayonAdmin)
		->get();
		return view('admin.export-excel.export-postingan', [        	
			'datas' => $data
		]);
	}
}
