<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komisariat;
use App\Rayon;
use DataTables;

class KomisariatController extends Controller
{
	public function index(Request $request){
		if ($request->ajax()) {
			$data = Komisariat::get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_komisariat.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edits">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_komisariat.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.komisariat');
	}

	public function store(Request $request){
		$check = Komisariat::where('id_komisariat', $request->kom_id)->first();
		if(!$check){
			Komisariat::create([
				'nama_komisariat' => $request->nama
			]);
			return response()->json(['success'=>'Komisariat Disimpan.']);
		} else {
			Komisariat::where('id_komisariat', $request->kom_id)->update([
				'nama_komisariat' => $request->nama
			]);
			return response()->json(['success'=>'Komisariat Diedit.']);
		}
	}

	public function edit($id){
		$kom = Komisariat::where('id_komisariat', $id)->first(['nama_komisariat', 'id_komisariat']);
		return response()->json($kom);
	}

	public function destroy($id){
		Komisariat::where('id_komisariat', $id)->delete();
		Rayon::where('id_komisariat', $id)->delete();
		return response()->json(['success'=>'Komisariat Dihapus.']);
	}
}
