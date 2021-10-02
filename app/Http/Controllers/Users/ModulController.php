<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;
use Carbon\Carbon;
use Auth;
use DataTables;
use Validator;

class ModulController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	
	public function index(Request $request){ 
		if ($request->ajax()) {
			$data = Modul::get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEvent">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent">Delete</a>';

				return $btn;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('users.modul');
	}

	public function store(Request $request){
		$validation = Validator::make($request->all(), [
			'select_file' => "required|mimes:pdf|max:10000"
		]);
		if($validation->passes()){
			$files = $request->file('select_file');
			$new_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
			$files->move(storage_path('app/public/modul'), $new_name);
			$type = $files->getClientOriginalExtension();

			Modul::updateOrCreate(
				['id' => $request->post_id],
				[
					'id_user' => Auth::user()->id,
					'jenis_post' => 1,
					'judul_post' => $request->judul,
					'tanggal_post' => Carbon::now()->format('d-m-Y'),
					'keterangan_post' => $request->keterangan,
					'post' => $new_name,
					'format_post' => $type
				]
			);

			return response()->json();
		} else {
			return response()->json([
				'message'   => $validation->errors()->all(),
			]);
		}
	}

	public function edit($id){
		$modul = Modul::find($id);
		return response()->json([
			$modul
		]);
	}

	public function destroy($id){
		Modul::where('id', $id)->delete();
		return response()->json([
			'success' => 'Data Telah Terhapus'
		]);
	}
}
