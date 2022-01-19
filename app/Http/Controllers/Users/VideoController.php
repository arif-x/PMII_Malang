<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use Carbon\Carbon;
use Auth;
use Http;
use Validator;
use File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	
	public function index(Request $request){ 		
		$data = Video::join('profile', 'profile.id_user', '=', 'postingan.id_user')
		->where('jenis_post', 2)
		// ->where('postingan.id_user', Auth::user()->id)
		->select('postingan.*', 'profile.nama_lengkap')
		->orderBy('id_post', 'DESC')
		->paginate(10);		
		return view('users.video', ['video' => $data]);
	}

	public function store(Request $request){
		$validation = Validator::make($request->all(), [
			'select_file' => "required|mimes:mp4",
			'judul' => 'required|string',
			'keterangan' => 'required|string'
		]);
		$validator = Validator::make($request->all(), [
			'judul' => 'required|string',
			'keterangan' => 'required|string'
		]);
		if($validation->passes()){
			$datas = Video::where('id_user', Auth::user()->id)->where('id_post', $request->post_id)->first();

			if(empty($datas)){
				$files = $request->file('select_file');
				$new_name = url('/storage/video') . '/' . Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$file_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$file_val = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
				$files->move(storage_path('app/public/video'), $file_name);
				$type = $files->getClientOriginalExtension();

				Video::create(
					[
						'id_user' => Auth::user()->id,
						'jenis_post' => 2,
						'judul_post' => $request->judul,
						'tanggal_post' => Carbon::now()->format('d-m-Y'),
						'keterangan_post' => $request->keterangan,
						'post' => $new_name,
						'file' => $file_val,
						'format_post' => $type
					]
				);

				$apiURL = 'https://api.ika-pmiikotamalang.or.id/api/Notif_web';
				$postInput = [
					'api-key' => 'qwerty',
					'jenis_post' => 2,
					'judul_post' =>  $request->judul,
					'keterangan_post' => $request->keterangan,
				];
				$headers = [];

				$response = Http::withHeaders($headers)->post($apiURL, $postInput);
				$responseBody = json_decode($response->getBody(), true);

				return back();
			} else {
				$datas = Video::where('id_user', Auth::user()->id)->where('id_post', $request->post_id)->pluck('post');
				$fileData = str_replace('["', '', $datas);
				$fileData = str_replace('"]', '', $fileData);

				unlink(storage_path('app/public/video/'.$fileData.'.pdf'));

				$files = $request->file('select_file');
				$new_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$file_name = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s') . '.' . $files->getClientOriginalExtension();
				$file_val = Auth::user()->id . '-' .Carbon::now()->format('d-m-Y'). '-' .Carbon::now()->format('H-i-s');
				$files->move(storage_path('app/public/video'), $file_name);
				$type = $files->getClientOriginalExtension();

				Video::where('id', $request->post_id)->update(
					[
						'id_user' => Auth::user()->id,
						'jenis_post' => 2,
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
			$datas = Video::where('id_user', Auth::user()->id)->where('id_post', $request->post_id)->first();
			if(!empty($datas)){
				Video::where('id', $request->post_id)->update(
					[
						'id_user' => Auth::user()->id,
						'jenis_post' => 2,
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
		$video = Video::where('id_user', Auth::user()->id)->find($id);
		return response()->json($video);
	}

	public function destroy($id){
		$datas = Video::where('id_user', Auth::user()->id)->where('id', $id)->pluck('post');
		$fileData = str_replace('["', '', $datas);
		$fileData = str_replace('"]', '', $fileData);

		unlink(storage_path('app/public/video/'.$fileData.'.pdf'));

		Video::where('id', $id)->where('id_user', Auth::user()->id)->delete();
		return response()->json([
			'success' => 'Data Telah Terhapus'
		]);
	}
}
