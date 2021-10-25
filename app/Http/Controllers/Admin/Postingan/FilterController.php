<?php

namespace App\Http\Controllers\Admin\Postingan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postingan;
use App\Komisariat;
use DataTables;

class FilterController extends Controller
{
    public function index(Request $request){
    	if ($request->ajax()) {
			$data = Postingan::join('profile', 'profile.id_user', '=', 'postingan.id_user')
    		->join('jenis_post', 'jenis_post.id_jenis_post', 'postingan.jenis_post')
    		->join('kaderisasi', 'kaderisasi.id_user', '=', 'postingan.id_user')
    		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
    		->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
    		->select('postingan.*', 'profile.nama_lengkap', 'jenis_post.jenis_post as jenis', 'komisariat.nama_komisariat', 'rayon.nama_rayon', 'kaderisasi.komisariat', 'kaderisasi.rayon')
			->when(!empty($request->komisariat), function($query) use ($request){
				$query->where('kaderisasi.komisariat', $request->komisariat);
			})
			->when(!empty($request->rayon), function($query) use ($request){
				$query->where('kaderisasi.rayon', $request->rayon);
			})			
			->get();	

			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('detail', function($row){

				$btn = '<a href="/admin/postingan/detail/' . $row->id_post . '" data-toggle="tooltip"  data-id="'.$row->id_post.'" data-original-title="Edit" class="edit btn btn-primary btn-sm details">Detail</a>';

				return $btn;
			})
			->rawColumns(['detail'])
			->make(true);
		}

		$komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');

		return view('admin.postingan-filter', compact('komisariat'));
    }
}
