<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rayon;
use App\Komisariat;
use DataTables;

class RayonController extends Controller
{
	public function index(Request $request){
		$komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');		
		if ($request->ajax()) {
			$data = Rayon::join('komisariat', 'komisariat.id_komisariat', '=', 'rayon.id_komisariat')
			->select('rayon.*', 'komisariat.nama_komisariat')
			->get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_rayon.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edits">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_rayon.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.rayon', compact('komisariat'));
	}

	public function store(Request $request){
		$check = Rayon::where('id_rayon', $request->rayon_id)->first();
		if(!$check){
			Rayon::create([
				'id_komisariat' => $request->komisariat,
				'nama_rayon' => $request->nama
			]);
			return response()->json(['success'=>'Rayon Disimpan.']);
		} else {
			Rayon::where('id_rayon', $request->rayon_id)->update([
				'id_komisariat' => $request->komisariat,
				'nama_rayon' => $request->nama
			]);
			return response()->json(['success'=>'Rayon Diedit.']);
		}
	}

	public function edit($id){
		$kom = Rayon::join('komisariat', 'komisariat.id_komisariat', '=', 'rayon.id_komisariat')
		->where('id_rayon', $id)->first();
		return response()->json($kom);
	}

	public function destroy($id){
		Rayon::where('id_rayon', $id)->delete();
		Rayon::where('id_rayon', $id)->delete();
		return response()->json(['success'=>'Rayon Dihapus.']);
	}

	public function getKom($id){
		$data = Rayon::join('komisariat', 'komisariat.id_komisariat', '=', 'rayon.id_komisariat')
		->where('id_rayon', $id)
		->select('rayon.*', 'komisariat.nama_komisariat')
		->pluck('komisariat.nama_komisariat', 'id_komisariat');
		return response()->json($data);
	}
}
