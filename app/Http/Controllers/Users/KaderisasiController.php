<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Kaderisasi;
use App\Komisariat;
use App\KaderisasiTerakhir;
use Auth;
use App\User;

class KaderisasiController extends Controller
{
	public function index(){
		$komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
		$kaderisasi_terakhir = KaderisasiTerakhir::pluck('kaderisasi_terakhir', 'id_kaderisasi_terakhir');
		
		return view('users.kaderisasi', compact('komisariat', 'kaderisasi_terakhir'));
	}

	public function store(Request $request){
		$validation = Validator::make($request->all(), [
			'komisariatPenyelenggara' => 'required|integer',
			'rayonPenyelenggara' => 'required|integer',
			'tahun' => 'required|integer',
			'angkatan' => 'required|integer',
			'kaderisasiTerakhir' => 'required|integer',          
		]);

		if($validation->fails()) {
			return back()->withErrors($validation);
		}

		if($validation->passes()){
			Kaderisasi::where('id_user', Auth::user()->id)->update([
				'komisariat' => $request->komisariatPenyelenggara,
				'rayon' => $request->rayonPenyelenggara,
				'tahun_bergabung' => $request->tahun,
				'angkatan_ke' => $request->angkatan,
				'kaderisasi_terakhir' => $request->kaderisasiTerakhir,
			]);

			User::where('id', Auth::user()->id)->update([
				'status_profile' => 3
			]);
			return redirect('/home');
		} else {
			return back()->with('message', $validation->errors()->all());
		}
	}
}
