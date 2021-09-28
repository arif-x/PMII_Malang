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
            Profile::where('id_user', Auth::user()->id)->pluck('nik') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('nim') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tempat_lahir') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tanggal_lahir') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('jenis_kelamin') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('provinsi') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kota_kabupaten') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kecamatan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('desa_kelurahan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('rt') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('rw') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('alamat_lengkap') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('komisariat') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('rayon') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('status_pernikahan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pendidikan_terakhir') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pekerjaan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('gol_darah') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('no_hp') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('foto_terbaru') == '[null]' ||

            // Kaderisasi
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('komisariat') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('rayon') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('tahun_bergabung') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('angkatan_ke') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('kaderisasi_terakhir') == '[null]'
        ){
            return redirect('/home')->with('info', 'Lengkapi Biodata');            
        }                
        return $next($request);
    }
}
