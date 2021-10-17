<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;
use Carbon\Carbon;
use Auth;
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
		$data = Modul::join('profile', 'profile.id_user', '=', 'postingan.id_user')
		->where('jenis_post', 1)
		->where('postingan.id_user', Auth::user()->id)
		->select('postingan.*', 'profile.nama_lengkap')
		->paginate(15);		
		return view('users.modul', ['modul' => $data]);
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
			$datas = Modul::where('id_user', Auth::user()->id)->where('id_post', $request->post_id)->first();

			if(empty($datas)){
				$files = $request->file('select_file');
				$new_name = url('/storage/modul') . '/' . Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
				$file_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$file_val = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
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
						'file' => $file_val,
						'format_post' => $type
					]
				);

				return back();
			} else {
				$datas = Modul::where('id_user', Auth::user()->id)->where('id_post', $request->post_id)->pluck('post');
				$fileData = str_replace('["', '', $datas);
				$fileData = str_replace('"]', '', $fileData);

				unlink(storage_path('app/public/modul/'.$fileData.'.pdf'));

				$files = $request->file('select_file');
				$new_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
				$file_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$file_val = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
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
						'file' => $file_val,
						'format_post' => $type
					]
				);
				return back();
			}			
		} elseif($validator->passes()){
			$datas = Modul::where('id_user', Auth::user()->id)->where('id_post', $request->post_id)->first();
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
				return back();
			}
		} else {
			return back()->with('message', $validation->errors()->all());
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
