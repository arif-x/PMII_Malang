<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;
use Carbon\Carbon;
use Auth;
use DataTables;
use Validator;
use File;

class ModulController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	
	public function index(Request $request){ 
		if ($request->ajax()) {
			$data = Modul::where('id_user', Auth::user()->id)->get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editModul">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-info btn-sm deleteModul">Delete</a>';

				return $btn;
			})
			->addColumn('lihat', function($row){
				$reveal = '<a href="/modul/files/'.$row->post.'.'.$row->format_post.'" target="_blank">Lihat</a>';

				return $reveal;
			})
			->addColumn('postingan', function($row){
				$reveal = $row->post.'.'.$row->format_post;

				return $reveal;
			})
			->rawColumns(['action', 'lihat', 'postingan'])
			->make(true);
		}

		return view('users.modul');
	}

	public function store(Request $request){
		$validation = Validator::make($request->all(), [
			'select_file' => "required|mimes:pdf|max:10000",
			'judul' => 'required|string',
			'keterangan' => 'required|string'
		]);
		$validator = Validator::make($request->all(), [
			'judul' => 'required|string',
			'keterangan' => 'required|string'
		]);
		if($validation->passes()){
			$datas = Modul::where('id_user', Auth::user()->id)->where('id', $request->post_id)->first();

			if(empty($datas)){
				$files = $request->file('select_file');
				$new_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
				$file_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$files->move(storage_path('app/public/modul'), $file_name);
				$type = $files->getClientOriginalExtension();

				Modul::create(
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
				$datas = Modul::where('id_user', Auth::user()->id)->where('id', $request->post_id)->pluck('post');
				$fileData = str_replace('["', '', $datas);
				$fileData = str_replace('"]', '', $fileData);

				unlink(storage_path('app/public/modul/'.$fileData.'.pdf'));

				$files = $request->file('select_file');
				$new_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
				$file_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$files->move(storage_path('app/public/modul'), $file_name);
				$type = $files->getClientOriginalExtension();

				Modul::where('id', $request->post_id)->update(
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
			}			
		} elseif($validator->passes()){
			$datas = Modul::where('id_user', Auth::user()->id)->where('id', $request->post_id)->first();
			if(!empty($datas)){
				Modul::where('id', $request->post_id)->update(
					[
						'id_user' => Auth::user()->id,
						'jenis_post' => 1,
						'judul_post' => $request->judul,
						'tanggal_post' => Carbon::now()->format('d-m-Y'),
						'keterangan_post' => $request->keterangan,
					]
				);
				return response()->json();
			}
		} else {
			return response()->json([
				'message'   => $validation->errors()->all(),
			]);
		}
	}

	public function edit($id){
		$modul = Modul::where('id_user', Auth::user()->id)->find($id);
		return response()->json($modul);
	}

	public function destroy($id){
		$datas = Modul::where('id_user', Auth::user()->id)->where('id', $id)->pluck('post');
		$fileData = str_replace('["', '', $datas);
		$fileData = str_replace('"]', '', $fileData);

		unlink(storage_path('app/public/modul/'.$fileData.'.pdf'));

		Modul::where('id', $id)->where('id_user', Auth::user()->id)->delete();
		return response()->json([
			'success' => 'Data Telah Terhapus'
		]);
	}
}
