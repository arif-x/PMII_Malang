<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Menu;

class MenuController extends Controller
{
	public function index(Request $request){
		if($request->ajax()){
			$data = Menu::get();
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($row){

				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_menu.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edits">Edit</a>';

				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_menu.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

				return $btn;
			})
			->addColumn('images', function($row){

				$img = '<img src='. $row->gambar_menu .' width="100px" height="auto">';

				return $img;
			})
			->rawColumns(['action', 'images'])
			->make(true);
		}
		return view('admin.menu');
	}

	public function store(Request $request){
		$menuId = $request->menu_id;
		if($menuId){
			$menu = Menu::where('id_menu', $menuId)->first();
			if($request->hasFile('image')){
				$image = $request->image;
				$file_name =  $request->nama . '.' . $image->getClientOriginalExtension();
				$image->move(storage_path('app/public/menu/'), $file_name);
				Menu::where('id_menu', $menuId)->update([
					'menu' => $request->nama,
					'gambar_menu' => url('/storage/menu') . '/' . $file_name
				]);
			} else {
				Menu::where('id_menu', $menuId)->update([
					'menu' => $request->nama,
				]);
			} 
		}else{
			$image = $request->image;
			$file_name =  $request->nama . '.' . $image->getClientOriginalExtension();
			$image->move(storage_path('app/public/menu/'), $file_name);
			Menu::create([
				'menu' => $request->nama,
				'gambar_menu' => url('/storage/menu') . '/' . $file_name
			]);
		}

		return Response()->json();
	}

	public function edit($id){
		$menu = Menu::where('id_menu', $id)->get();
		return response()->json($menu);
	}   

	public function destroy($id){
		$menu = Menu::where('id_menu', $id)->value('gambar_menu');
		$img = str_replace(url('storage/menu').'/', '', $menu);

		Menu::where('id_menu', $id)->delete();
		unlink(storage_path('app/public/menu/'.$img));
		return response()->json([
			'success' => 'Data Telah Terhapus'
		]);		
	} 
}