<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Slider;
use Carbon\Carbon;

class SliderController extends Controller
{
	public function index(Request $request){
		if($request->ajax()){
			$data = Slider::get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_slider.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edits">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_slider.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

				return $btn;
			})
			->addColumn('images', function($row){

				$img = '<img src='. $row->gambar_slide .' width="500" height="auto">';

				return $img;
			})
			->rawColumns(['action', 'images'])
			->make(true);
		}
		return view('admin.slider');
	}

	public function store(Request $request){
		$sliderId = $request->slider_id;
		if($sliderId){
			$slider = Slider::where('id_slider', $sliderId)->first();
			if($request->hasFile('image')){
				$image = $request->image;
				$file_name =  Carbon::now()->format('d-m-Y') . '.' . $image->getClientOriginalExtension();
				$image->move(storage_path('app/public/slider/'), $file_name);
				Slider::where('id_slider', $sliderId)->update([
					'gambar_slide' => url('/storage/slider') . '/' . $file_name
				]);
			}
		}else{
			$image = $request->image;
			$file_name =  Carbon::now()->format('d-m-Y') . '.' . $image->getClientOriginalExtension();
			$image->move(storage_path('app/public/slider/'), $file_name);
			Slider::create([
				'gambar_slide' => url('/storage/slider') . '/' . $file_name
			]);
		}

		return Response()->json();
	}

	public function edit($id){
		$slider = Slider::where('id_slider', $id)->get();
		return response()->json($slider);
	}   

	public function destroy($id){
		$slider = Slider::where('id_slider', $id)->value('gambar_slide');
		$img = str_replace(url('storage/slider').'/', '', $slider);

		Slider::where('id_slider', $id)->delete();
		unlink(storage_path('app/public/slider/'.$img));
		return response()->json([
			'success' => 'Data Telah Terhapus'
		]);	
	} 
}
