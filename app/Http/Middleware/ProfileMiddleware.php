<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Profile;

class ProfileMiddleware
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
            Profile::where('id_user', Auth::user()->id)->pluck('nama_lengkap') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tanggal_lahir') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('jenis_kelamin') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('provinsi') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kota_kabupaten') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kecamatan') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('alamat_lengkap') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('status_pernikahan') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pendidikan_terakhir') == '["-"]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pekerjaan') == '-' ||
            Profile::where('id_user', Auth::user()->id)->pluck('no_hp') == '-' ||
            Profile::where('id_user', Auth::user()->id)->pluck('foto_terbaru') == '-' || 

            Profile::where('id_user', Auth::user()->id)->pluck('nama_lengkap') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tanggal_lahir') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('jenis_kelamin') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('provinsi') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kota_kabupaten') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kecamatan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('alamat_lengkap') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('status_pernikahan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pendidikan_terakhir') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pekerjaan') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('no_hp') == '[]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('foto_terbaru') == '[]' ||            

            Profile::where('id_user', Auth::user()->id)->pluck('nama_lengkap') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('tanggal_lahir') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('jenis_kelamin') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('provinsi') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kota_kabupaten') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('kecamatan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('alamat_lengkap') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('status_pernikahan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pendidikan_terakhir') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('pekerjaan') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('no_hp') == '[null]' ||
            Profile::where('id_user', Auth::user()->id)->pluck('foto_terbaru') == '[null]'){
            return redirect('/new-profile')->with('info', 'Lengkapi Biodata');            
        } else {
            return $next($request);
        }          
    }
}
