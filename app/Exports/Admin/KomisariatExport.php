<?php

namespace App\Exports\Admin;

use App\Komisariat;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KomisariatExport implements FromView, ShouldAutoSize
{
    use Exportable;

	public function view(): View
	{
		$data = Komisariat::get();
		return view('admin.export-excel.export-komisariat', [        	
			'datas' => $data
		]);
	}
}
