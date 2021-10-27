<?php

namespace App\Http\Controllers\AdminKomisariat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rayon;
use App\Komisariat;
use DataTables;

class RayonController extends Controller
{
    public function index(Request $request){		
		if ($request->ajax()) {
			$data = Rayon::join('komisariat', 'komisariat.id_komisariat', '=', 'rayon.id_komisariat')
			->select('rayon.*', 'komisariat.nama_komisariat')
			->get();
			return Datatables::of($data)
			->addIndexColumn()
			->rawColumns(['action'])
			->make(true);
		}

		return view('komisariat.rayon');
	}
}
