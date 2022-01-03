<?php

namespace App\Exports\Admin;

use App\Rayon;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class RayonExport implements FromView, ShouldAutoSize
{
    use Exportable;

	public function view(): View
	{
		$data = Rayon::join('komisariat', 'komisariat.id_komisariat', '=', 'rayon.id_komisariat')
		->select('komisariat.nama_komisariat', 'rayon.*')
		->get();
		return view('admin.export-excel.export-rayon', [        	
			'datas' => $data
		]);
	}
}
