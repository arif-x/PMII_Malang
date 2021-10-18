<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;
use App\Video;
use App\Whistlist;
use Auth;

class PostController extends Controller
{
    public function modulSingle($file, $format){
    	$modul = Modul::join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
        ->where('file', $file)->where('format_post', $format)
        ->select('postingan.*', 'profile.nama_lengkap', 'profile.foto_terbaru', 'jenis_post.jenis_post as jenis')
        ->get();

        $id = Modul::join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
        ->where('file', $file)->where('format_post', $format)
        ->select('postingan.*', 'profile.nama_lengkap', 'profile.foto_terbaru', 'jenis_post.jenis_post as jenis')
        ->pluck('id_post');

        $id = str_replace('[', '', $id);
        $id_plucked = str_replace(']', '', $id);

        $save = Modul::join('save', 'save.id_user', '=', 'save.id_user')
        ->where('save.id_post', $id_plucked)->where('save.id_user', Auth::user()->id)
        ->select('save.*', 'postingan.id_post')
        ->get();
    	return view('users.modul-single', ['moduls' => $modul], compact('save', 'id'));
    }

    public function videoSingle($file, $format){
    	$video = Video::join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
        ->where('file', $file)->where('format_post', $format)
        ->select('postingan.*', 'profile.nama_lengkap', 'profile.foto_terbaru', 'jenis_post.jenis_post as jenis')
        ->get();

        $id = Video::join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
        ->where('file', $file)->where('format_post', $format)
        ->select('postingan.*', 'profile.nama_lengkap', 'profile.foto_terbaru', 'jenis_post.jenis_post as jenis')
        ->pluck('id_post');

        $id = str_replace('[', '', $id);
        $id_plucked = str_replace(']', '', $id);

        $save = Video::join('save', 'save.id_user', '=', 'save.id_user')
        ->where('save.id_post', $id_plucked)->where('save.id_user', Auth::user()->id)
        ->select('save.*', 'postingan.id_post')
        ->get();

    	return view('users.video-single', ['videos' => $video], compact('save', 'id'));
    }

    public function wp(){

    }
}
