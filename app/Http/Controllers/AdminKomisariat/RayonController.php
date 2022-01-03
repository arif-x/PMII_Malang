<?php

namespace App\Http\Controllers\AdminKomisariat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rayon;
use App\Komisariat;
use App\Kaderisasi;
use DataTables;
use Auth;

class RayonController extends Controller
{
    public function index(Request $request){		
		if ($request->ajax()) {
			$idKomAdmin = Kaderisasi::where('id_user', Auth::user()->id)->value('komisariat');
			$data = Rayon::join('komisariat', 'komisariat.id_komisariat', '=', 'rayon.id_komisariat')
			->select('rayon.*', 'komisariat.nama_komisariat', 'komisariat.id_komisariat')
			->where('komisariat.id_komisariat', $idKomAdmin)
			->get();
			return Datatables::of($data)
			->addIndexColumn()
			->rawColumns(['action'])
			->make(true);
		}

		return view('komisariat.rayon');
	}
}
