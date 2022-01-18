<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Komisariat;
use App\Pekerjaan;
use App\Pendidikan;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\KoordinatUser;
use App\Koordinat;
use App\KoordinatKab;
use Validator;
use Carbon\Carbon;
use Auth;

class NewProfileController extends Controller
{
  public function newIndex(){
    $komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
    $pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
    $pendidikan = Pendidikan::pluck('pendidikan', 'id_pendidikan');
    $provinsi = Provinsi::pluck('name', 'id');
    return view('users.new-profile', compact('komisariat', 'pekerjaan', 'pendidikan', 'provinsi'));
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
      'noHp' => 'required|numeric',  
      'pasFoto' => "required|image|mimes:jpg,png,jpeg",
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
        'foto_terbaru' => env('APP_URL').'/storage/foto/'.$new_name,
      ]);

      User::where('id', Auth::user()->id)->update([
        'status_profile' => 2,
      ]);

      $prov = Provinsi::where('id', $request->provinsi)->value('id');        

      $kabData = Kabupaten::where('id', $request->kabupaten)->value('id');
      $kab = (int)substr($kabData, 2);        

      $kecData = Kecamatan::where('id', $request->kecamatan)->value('id');
      $kec = (int)substr($kecData, 4);        

      $koordinat = Koordinat::where('province_code', $prov)
      ->where('kabupaten_code', $kab) 
      ->where('kecamatan_code', $kec)        
      ->first();

      if(empty($koordinat)){
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
        return redirect('/new-kaderisasi');
      }

      $lat = Koordinat::where('province_code', $prov)
      ->where('kabupaten_code', $kab) 
      ->where('kecamatan_code', $kec)        
      ->value('lat');

      $lng = Koordinat::where('province_code', $prov)
      ->where('kabupaten_code', $kab) 
      ->where('kecamatan_code', $kec)        
      ->value('lng');

      $users = KoordinatUser::where('id_user', Auth::user()->id)->first();
      if(empty($users)){
        KoordinatUser::create(            
          [
            'id_user' => Auth::user()->id,
            'lat' => $lat,
            'lng' => $lng,
          ]
        );            
      } else {
        KoordinatUser::where('id_user', Auth::user()->id)->update(            
          [
            'id_user' => Auth::user()->id,
            'lat' => $lat,
            'lng' => $lng,
          ]
        );
      }    
      return redirect('/new-kaderisasi');
    } else {
      return redirect()->back()->withErrors($validation);
    }
  }
}
