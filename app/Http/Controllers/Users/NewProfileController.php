<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Validator;
use Carbon\Carbon;
use Auth;

class NewProfileController extends Controller
{
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
      'statusKawin' => 'required|in:kawin,belum kawin',
      'pekerjaan' => 'required|integer',
      'noHp' => 'required|integer',  
      'pasFoto' => "required|image|mimes:jpg,png,jpeg",
    ]);

    if($validation->passes()){

      $files = $request->file('pasFoto');
      $new_name = Auth::user()->id . '-' . Auth::user()->name;
      $files->move(storage_path('app/public/foto'), $new_name.'.'.$files->getClientOriginalExtension());

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

      User::where('id', Auth::user()->id)->update([
        'status_profile' => 2,
      ]);
      return redirect('/new-kaderisasi');
    } else {
      return redirect()->back()->withErrors($validation);
    }
  }
}
