<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komisariat;
use App\Provinsi;
use App\Profile;
use App\Kabupaten;
use App\Kecamatan;
use App\Pekerjaan;
use App\Kaderisasi;
use App\Pendidikan;
use App\KaderisasiTerakhir;
use App\User;
use App\KoordinatUser;
use App\Koordinat;
use App\KoordinatKab;
use Carbon\Carbon;
use Auth;
use Validator;
use Http;

class ProfileController extends Controller
{  

  public function index(){
    $profile = Profile::where('id_user', Auth::user()->id)
    ->join('pekerjaan', 'pekerjaan.id_pekerjan', '=', 'profile.pekerjaan')
    ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'profile.pendidikan_terakhir')
    ->join('wilayah_provinsi', 'wilayah_provinsi.id', '=', 'profile.provinsi')
    ->join('wilayah_kabupaten', 'wilayah_kabupaten.id', '=', 'profile.kota_kabupaten')
    ->join('wilayah_kecamatan', 'wilayah_kecamatan.id', '=', 'profile.kecamatan')
    ->select(
      'profile.*', 
      'pekerjaan.id_pekerjan as id_kerja',
      'pekerjaan.pekerjan as nama_kerja',      
      'pendidikan.pendidikan as nama_pendidikan',
      'wilayah_provinsi.id as prov_id',
      'wilayah_provinsi.name as nama_prov',
      'wilayah_kabupaten.id as kab_id',
      'wilayah_kabupaten.name as nama_kab',
      'wilayah_kecamatan.id as kec_id',
      'wilayah_kecamatan.name as nama_kec',
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

    return view('users.profile', compact('komisariat', 'pekerjaan', 'profile', 'kaderisasi', 'pendidikan', 'kaderisasiterakhir', 'provinsi'));
  }

  public function store(Request $request){

    if($request->hasFile('pasFoto')){

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
        'noHp' => 'required|numeric',  
        'pasFoto' => "required|image|mimes:jpg,png,jpeg",

        'komisariatPenyelenggara' => 'required|integer',
        'rayonPenyelenggara' => 'required|integer',
        'tahun' => 'required|integer',
        'kaderisasiTerakhir' => 'required|string',
      ]);

      if($validation->passes()){

        $files = $request->file('pasFoto');
        $new_name = Auth::user()->id . '-' . $request->nama.'.'.$files->getClientOriginalExtension();
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

        return back();
      } else {
        return redirect()->back()->withErrors($validation);
      }
    } elseif(!$request->hasFile('pasFoto')){
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
        'noHp' => 'required|numeric',  

        'komisariatPenyelenggara' => 'required|integer',
        'rayonPenyelenggara' => 'required|integer',
        'tahun' => 'required|integer',
        'kaderisasiTerakhir' => 'required|string',
      ]);

      if($validation->passes()){

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
        ]);

        Kaderisasi::where('id_user', Auth::user()->id)->update([
          'komisariat' => $request->komisariatPenyelenggara,
          'rayon' => $request->rayonPenyelenggara,
          'tahun_bergabung' => $request->tahun,
          'angkatan_ke' => $request->angkatan,
          'kaderisasi_terakhir' => $request->kaderisasiTerakhir
        ]);

        $prov = Provinsi::where('id', $request->provinsi)->value('id');        

        $kabData = Kabupaten::where('id', $request->kabupaten)->value('id');
        $kab = (int)substr($kabData, 2);        

        // $kecData = Kecamatan::where('id', $request->kecamatan)->value('id');
        // $kec = (int)substr($kecData, 4);        

        // $koordinat = Koordinat::where('province_code', $prov)
        // ->where('kabupaten_code', $kab) 
        // ->where('kecamatan_code', $kec)        
        // ->first();

        // if(empty($koordinat)){
          $lat2 = KoordinatKab::where('kode', $prov.substr($kabData, 2))->value('lat');
          $lng2 = KoordinatKab::where('kode', $prov.substr($kabData, 2))->value('lng');

          $users = KoordinatUser::where('id_user', Auth::user()->id)->first();
          if(empty($users)){
            KoordinatUser::create(            
              [
                'id_user' => Auth::user()->id,
                'lat' => $lat2,
                'lng' => $lng2,
              ]
            );            
          } else {
            KoordinatUser::where('id_user', Auth::user()->id)->update(            
              [
                'id_user' => Auth::user()->id,
                'lat' => $lat2,
                'lng' => $lng2,
              ]
            );
          } 
        //   return back();
        // }

        // $lat = Koordinat::where('province_code', $prov)
        // ->where('kabupaten_code', $kab) 
        // ->where('kecamatan_code', $kec)        
        // ->value('lat');

        // $lng = Koordinat::where('province_code', $prov)
        // ->where('kabupaten_code', $kab) 
        // ->where('kecamatan_code', $kec)        
        // ->value('lng');

        // $users = KoordinatUser::where('id_user', Auth::user()->id)->first();
        // if(empty($users)){
        //   KoordinatUser::create(            
        //     [
        //       'id_user' => Auth::user()->id,
        //       'lat' => $lat,
        //       'lng' => $lng,
        //     ]
        //   );            
        // } else {
        //   KoordinatUser::where('id_user', Auth::user()->id)->update(            
        //     [
        //       'id_user' => Auth::user()->id,
        //       'lat' => $lat,
        //       'lng' => $lng,
        //     ]
        //   );
        // }    

        return back();
      } else {
        return redirect()->back()->withErrors($validation);
      }
    }
  }
}
