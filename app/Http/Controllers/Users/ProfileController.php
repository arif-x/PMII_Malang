<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komisariat;
use App\Provinsi;
use App\Profile;
use App\Pekerjaan;
use App\Kaderisasi;
use Auth;
use Validator;

class ProfileController extends Controller
{
    public function index(){
    	$profile = Profile::where('id_user', Auth::user()->id)
    	->join('provinces', 'provinces.id', '=', 'profile.provinsi')
    	->join('regencies', 'regencies.id', '=', 'profile.kota_kabupaten')
    	->join('districts', 'districts.id', '=', 'profile.kecamatan')
    	->join('villages', 'villages.id', '=', 'profile.desa_kelurahan')
    	->join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
    	->join('komisariat', 'komisariat.id_komisariat', '=', 'profile.komisariat')
    	->join('rayon', 'rayon.id_rayon', '=', 'profile.rayon')
    	->select(
    		'profile.*', 
    		'provinces.id as prov_id', 
    		'provinces.name as prov_name', 
    		'regencies.id as reg_id',
    		'regencies.name as reg_name',
    		'districts.id as dis_id',
    		'districts.name as dis_name',
    		'villages.id as vil_id',
    		'villages.name as vil_name',
    		'pekerjaan.id_pekerjan as id_kerja',
    		'pekerjaan.pekerjan as nama_kerja',
    		'komisariat.id_komisariat',
    		'komisariat.nama_komisariat',
    		'rayon.id_rayon',
    		'rayon.nama_rayon'
    	)
    	->get();
    	$kaderisasi = Kaderisasi::where('id_user', Auth::user()->id)
    	->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
    	->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
    	->select(
    		'kaderisasi.*',
    		'komisariat.id_komisariat',
    		'komisariat.nama_komisariat',
    		'rayon.id_rayon',
    		'rayon.nama_rayon'
    	)
    	->get();
    	$provinsi = Provinsi::pluck('name', 'id');
    	$komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
    	$pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
    	return view('users.profile', compact('provinsi', 'komisariat', 'pekerjaan', 'profile', 'kaderisasi'));
    }

    public function submit(Request $request){
        $validation = Validator::make($request->all(), [
            'nik' => "required|integer",
            'ktm' => 'required|string',
            // 'name' => 'required|string|255',
            'tempatLahir' => 'required|string',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:Laki-Laki,Perempuan',
            'provinsi' => "required|integer",
            'kabupaten' => "required|integer",
            'kecamatan' => "required|integer",
            'kelurahan' => "required|integer",
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'alamat' => 'required',
            'komisariat' => 'required|integer',
            'rayon' => 'required|integer',
            'fakultas' => 'required',
            'statusKawin' => 'required|in:kawin,belum kawin',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|integer',
            'golonganDarah' => 'required|string',
            'noHp' => 'required|integer',
            // 'pasFoto' => "required|mimes:jpg,png|max:10000",

            'komisariatPenyelenggara' => 'required|integer',
            'rayonPenyelenggara' => 'required|integer',
            'tahun' => 'required|integer',
            'kaderisasiTerakhir' => 'required|string',          
        ]);

        if($validation->fails()) {
            return back()->withErrors($validation);
        }

        if($validation->passes()){
            Profile::where('id_user', Auth::user()->id)->update([
              'nik' => $request->nik,
              'nim' => $request->ktm,
              'nama_lengkap' => Auth::user()->name,
              'tempat_lahir' => $request->tempatLahir,
              'tanggal_lahir' => $request->tanggalLahir,
              'jenis_kelamin' => $request->jenisKelamin,
              'provinsi' => $request->provinsi,
              'kota_kabupaten' => $request->kabupaten,
              'kecamatan' => $request->kecamatan,
              'desa_kelurahan' => $request->kelurahan,
              'rt' => $request->rt,
              'rw' => $request->rw,
              'alamat_lengkap' => $request->alamat,
              'komisariat' => $request->komisariat,
              'rayon' => $request->rayon,
              'fakultas' => $request->fakultas,
              'status_pernikahan' => $request->statusKawin,
              'pendidikan_terakhir' => $request->pendidikan,
              'pekerjaan' => $request->pekerjaan,
              'gol_darah' => $request->golonganDarah,
              'no_hp' => $request->noHp,
              'foto_terbaru' => $request->pasFoto,
          ]);

            Kaderisasi::where('id_user', Auth::user()->id)->update([
              'komisariat' => $request->komisariatPenyelenggara,
              'rayon' => $request->rayonPenyelenggara,
              'tahun_bergabung' => $request->tahun,
              'angkatan_ke' => $request->angkatan,
              'kaderisasi_terakhir' => $request->kaderisasiTerakhir,
          ]);
            return redirect('/profile');
        } else {
            return back()->with('message', $validation->errors()->all());
        }
    }
}
