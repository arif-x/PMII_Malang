<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komisariat;
use App\Provinsi;
use App\Profile;
use App\Pekerjaan;
use App\Kaderisasi;
use App\Pendidikan;
use App\KaderisasiTerakhir;
use App\User;
use Carbon\Carbon;
use Auth;
use Validator;

class ProfileController extends Controller
{
  public function newIndex(){
    $provinsi = Provinsi::pluck('name', 'id');
    $komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
    $pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
    $pendidikan = Pendidikan::pluck('pendidikan', 'id_pendidikan');
    return view('users.new-profile', compact('provinsi', 'komisariat', 'pekerjaan', 'pendidikan'));
  }
  
  public function index(){
    $profile = Profile::where('id_user', Auth::user()->id)
    ->join('provinces', 'provinces.id', '=', 'profile.provinsi')
    ->join('regencies', 'regencies.id', '=', 'profile.kota_kabupaten')
    ->join('districts', 'districts.id', '=', 'profile.kecamatan')
    ->join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
    ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'profile.pendidikan_terakhir')
    ->select(
      'profile.*', 
      'provinces.id as prov_id', 
      'provinces.name as prov_name', 
      'regencies.id as reg_id',
      'regencies.name as reg_name',
      'districts.id as dis_id',
      'districts.name as dis_name',
      'pekerjaan.id_pekerjan as id_kerja',
      'pekerjaan.pekerjan as nama_kerja',
      'pendidikan.pendidikan as nama_pendidikan'
    )->get();
    $kaderisasi = Kaderisasi::where('id_user', Auth::user()->id)
    ->join('komisariat', 'komisariat.id_komisariat', '=', 'kaderisasi.komisariat')
    ->join('rayon', 'rayon.id_rayon', '=', 'kaderisasi.rayon')
    ->join('kaderisasi_terakhir', 'kaderisasi_terakhir.id_kaderisasi_terakhir', '=', 'kaderisasi.kaderisasi_terakhir')
    ->select(
      'kaderisasi.*',
      'komisariat.id_komisariat',
      'komisariat.nama_komisariat',
      'rayon.id_rayon',
      'rayon.nama_rayon',
      'kaderisasi_terakhir.kaderisasi_terakhir as kad_terakhir'
    )
    ->get();
    $pendidikan = Pendidikan::pluck('pendidikan', 'id_pendidikan');
    $kaderisasiterakhir = KaderisasiTerakhir::pluck('kaderisasi_terakhir', 'id_kaderisasi_terakhir');
    $provinsi = Provinsi::pluck('name', 'id');
    $komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
    $pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
    return view('users.profile', compact('provinsi', 'komisariat', 'pekerjaan', 'profile', 'kaderisasi', 'pendidikan', 'kaderisasiterakhir'));
  }

  public function store(Request $request){
    $validation = Validator::make($request->all(), [
      'nama' => 'required|string',
      'tanggalLahir' => 'required|date',
      'jenisKelamin' => 'required|in:Laki-Laki,Perempuan',
      'provinsi' => "required|integer",
      'kabupaten' => "required|integer",
      'kecamatan' => "required|integer",
      'alamat' => 'required',
      'pendidikan' => 'required',
      'statusKawin' => 'required|in:Menikah,Belum Menikah',
      'pekerjaan' => 'required|integer',
      'noHp' => 'required|integer',  
      'pasFoto' => "required|image|mimes:jpg,png,jpeg",

      'komisariatPenyelenggara' => 'required|integer',
      'rayonPenyelenggara' => 'required|integer',
      'tahun' => 'required|integer',
      'kaderisasiTerakhir' => 'required|string',
    ]);

    if($validation->passes()){

      $files = $request->file('pasFoto');
      $new_name = Auth::user()->id . '-' . Auth::user()->name.'.'.$files->getClientOriginalExtension();
      $files->move(storage_path('app/public/foto'), $new_name);

      Profile::where('id_user', Auth::user()->id)->update([
        'nama_lengkap' => $request->nama,
        'tanggal_lahir' => Carbon::parse($request->tanggalLahir)->format('d/m/Y'),
        'jenis_kelamin' => $request->jenisKelamin,
        'provinsi' => $request->provinsi,
        'kota_kabupaten' => $request->kabupaten,
        'kecamatan' => $request->kecamatan,
        'alamat_lengkap' => $request->alamat,
        'status_pernikahan' => $request->statusKawin,
        'pendidikan_terakhir' => $request->pendidikan,
        'pekerjaan' => $request->pekerjaan,
        'no_hp' => $request->noHp,
        'foto_terbaru' => $new_name,
      ]);

      Kaderisasi::where('id_user', Auth::user()->id)->update([
        'komisariat' => $request->komisariatPenyelenggara,
        'rayon' => $request->rayonPenyelenggara,
        'tahun_bergabung' => $request->tahun,
        'angkatan_ke' => $request->angkatan,
        'kaderisasi_terakhir' => $request->kaderisasiTerakhir
      ]);

      return redirect('/home');
    } else {
          return redirect()->back()->withErrors($validation);
    }
  }
}
