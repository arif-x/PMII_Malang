<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\Kaderisasi;

class VerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (
            // Profile
            Profile::where('id_user', Auth::user()->id)->pluck('nik') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('nim') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tempat_lahir') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tanggal_lahir') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('jenis_kelamin') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('provinsi') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kota_kabupaten') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kecamatan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('desa_kelurahan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('rt') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('rw') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('alamat_lengkap') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('komisariat') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('rayon') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('status_pernikahan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pendidikan_terakhir') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pekerjaan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('gol_darah') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('no_hp') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('foto_terbaru') == '[]' ||

            // Kaderisasi
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('komisariat') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('rayon') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('tahun_bergabung') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('angkatan_ke') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('kaderisasi_terakhir') == '[]'
        ){
            return redirect('/home')->with('info', 'Lengkapi Biodata');            
        } else {
            return $next($request);
        }          
    }
}
