<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendidikan;
use DataTables;

class PendidikanController extends Controller
{
	public function index(Request $request){
		if ($request->ajax()) {
			$data = Pendidikan::get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_pendidikan.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edits">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_pendidikan.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.pendidikan');
	}

	public function store(Request $request){
		$check = Pendidikan::where('id_pendidikan', $request->pendidikan_id)->first();
		if(!$check){
			Pendidikan::create([
				'pendidikan' => $request->nama
			]);
			return response()->json(['success'=>'Pendidikan Disimpan.']);
		} else {
			Pendidikan::where('id_pendidikan', $request->pendidikan_id)->update([
				'pendidikan' => $request->nama
			]);
			return response()->json(['success'=>'Pendidikan Diedit.']);
		}
	}

	public function edit($id){
		$kom = Pendidikan::where('id_pendidikan', $id)->first(['pendidikan', 'id_pendidikan']);
		return response()->json($kom);
	}

	public function destroy($id){
		Pendidikan::where('id_pendidikan', $id)->delete();
		return response()->json(['success'=>'Pendidikan Dihapus.']);
	}
}
