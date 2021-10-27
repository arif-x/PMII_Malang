<?php

namespace App\Http\Controllers\AdminRayon\Postingan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use App\Komisariat;
use App\Rayon;
use App\Postingan;


class AllController extends Controller
{
    public function index(Request $request){
    	if($request->ajax()){
    		$data = Postingan::join('profile', 'profile.id_user', '=', 'postingan.id_user')
    		->join('jenis_post', 'jenis_post.id_jenis_post', 'postingan.jenis_post')
    		->join('kaderisasi', 'kaderisasi.id_user', '=', 'profile.id_user')
    		->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
    		->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
    		->select('postingan.*', 'profile.nama_lengkap', 'jenis_post.jenis_post as jenis', 'komisariat.nama_komisariat', 'rayon.nama_rayon')
    		->where('rayon.id_rayon', DB::raw('(SELECT kaderisasi.rayon FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
    		->get();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('detail', function($row){

				$btn = '<a href="/admin-rayon/postingan/detail/' . $row->id_post . '" data-toggle="tooltip"  data-id="'.$row->id_post.'" data-original-title="Edit" class="edit btn btn-primary btn-sm details">Detail</a>';

				return $btn;
			})
			->rawColumns(['detail'])
    		->make(true);
    	}

    	$rayon = Rayon::join('kaderisasi', 'kaderisasi.rayon', '=', 'rayon.id_rayon')
		->where('rayon.id_rayon', DB::raw('(SELECT kaderisasi.rayon FROM kaderisasi INNER JOIN profile ON profile.id_user = kaderisasi.id_user where profile.id_user = '. Auth::user()->id .')'))
		->pluck('rayon.nama_rayon', 'rayon.id_rayon');

    	return view('rayon.postingan', compact('rayon'));
    }

    public function edit($id){

    }
}

