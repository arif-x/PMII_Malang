<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Kaderisasi;

class KaderisasiMiddleware
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
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('komisariat') == '["-"]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('rayon') == '["-"]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('tahun_bergabung') == '["-"]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('angkatan_ke') == '["-"]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('kaderisasi_terakhir') == '["-"]' ||

            Kaderisasi::where('id_user', Auth::user()->id)->pluck('komisariat') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('rayon') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('tahun_bergabung') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('angkatan_ke') == '[]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('kaderisasi_terakhir') == '[]' ||

            Kaderisasi::where('id_user', Auth::user()->id)->pluck('komisariat') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('rayon') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('tahun_bergabung') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('angkatan_ke') == '[null]' ||
            Kaderisasi::where('id_user', Auth::user()->id)->pluck('kaderisasi_terakhir') == '[null]'){
            return redirect('/new-kaderisasi')->with('info', 'Lengkapi Data Kaderisasi');            
        } else {
            return $next($request);
        }          
    }
}
