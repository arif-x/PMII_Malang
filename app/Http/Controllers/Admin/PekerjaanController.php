<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pekerjaan;
use DataTables;

class PekerjaanController extends Controller
{
    public function index(Request $request){
		if ($request->ajax()) {
			$data = Pekerjaan::get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_pekerjan.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edits">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_pekerjan.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.pekerjaan');
	}

	public function store(Request $request){
		$check = Pekerjaan::where('id_pekerjan', $request->pekerjan_id)->first();
		if(!$check){
			Pekerjaan::create([
				'pekerjan' => $request->nama
			]);
			return response()->json(['success'=>'Pekerjaan Disimpan.']);
		} else {
			Pekerjaan::where('id_pekerjan', $request->pekerjan_id)->update([
				'pekerjan' => $request->nama
			]);
			return response()->json(['success'=>'Pekerjaan Diedit.']);
		}
	}

	public function edit($id){
		$kom = Pekerjaan::where('id_pekerjan', $id)->first(['pekerjan', 'id_pekerjan']);
		return response()->json($kom);
	}

	public function destroy($id){
		Pekerjaan::where('id_pekerjan', $id)->delete();
		return response()->json(['success'=>'Pekerjaan Dihapus.']);
	}
}
