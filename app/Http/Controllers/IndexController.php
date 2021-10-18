<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modul;
use App\Video;

class IndexController extends Controller
{
    public function index(){
    	$video = Video::join('profile', 'profile.id_user', '=', 'postingan.id_user')
		->where('jenis_post', 2)
		->select('postingan.*', 'profile.nama_lengkap')
		->orderBy('id_post', 'DESC')
		->limit(4)
		->get();

		$modul = Video::join('profile', 'profile.id_user', '=', 'postingan.id_user')
		->where('jenis_post', 1)
		->select('postingan.*', 'profile.nama_lengkap')
		->orderBy('id_post', 'DESC')
		->limit(4)
		->get();

		return view('index', ['video' => $video, 'modul' => $modul]);
    }
}
