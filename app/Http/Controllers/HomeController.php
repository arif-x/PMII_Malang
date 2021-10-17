<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Modul;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['kaderisasi', 'profile', 'auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $modul = Modul::join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->where('jenis_post', 1)
        ->select('postingan.*', 'profile.nama_lengkap')
        ->orderBy('id_post', 'DESC')
        ->limit(5)
        ->get();

        $video = Video::join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->where('jenis_post', 2)
        ->select('postingan.*', 'profile.nama_lengkap')
        ->orderBy('id_post', 'DESC')
        ->limit(5)
        ->get();
        return view('home', ['moduls' => $modul, 'videos' => $video]);
    }
}
