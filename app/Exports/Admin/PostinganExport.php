<?php

namespace App\Exports\Admin;

use App\Postingan;

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
		$data = Postingan::join('profile', 'profile.id_user', '=', 'postingan.id_user')
		->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
		->select('jenis_post.jenis_post as kategori', 'profile.nama_lengkap', 'postingan.*')
		->get();
		return view('admin.export-excel.export-postingan', [        	
			'datas' => $data
		]);
	}
}
