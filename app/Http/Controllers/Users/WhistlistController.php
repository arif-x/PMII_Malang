<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Whistlist;
use App\Modul;
use App\Video;
use Auth;

class WhistlistController extends Controller
{
    public function index(){
        $data = Whistlist::join('postingan', 'postingan.id_post', '=', 'save.id_post')
        ->join('jenis_post', 'jenis_post.id_jenis_post', '=', 'postingan.jenis_post')
        ->join('profile', 'profile.id_user', '=', 'postingan.id_user')
        ->where('save.id_user', Auth::user()->id)
        ->select('save.*', 'postingan.judul_post', 'postingan.jenis_post', 'postingan.file', 'postingan.format_post', 'profile.nama_lengkap', 'jenis_post.jenis_post as jenis_postingan')
        ->orderBy('id_save', 'DESC')
        ->paginate(20);
        // dd($data);
        return view('users.whistlist', ['wlist' => $data]);
    }

    public function addModul($post_id){
    	Whistlist::create([
    		'id_user' => Auth::user()->id,
    		'id_post' => $post_id,
    		'keterangan' => 'Modul'
    	]);
    	return back();
    }

    public function removeModul($post_id){
    	Whistlist::where('id_post', $post_id)->where('id_user', Auth::user()->id)->delete();
    	return back();
    }

    public function addVideo($post_id){
    	Whistlist::create([
    		'id_user' => Auth::user()->id,
    		'id_post' => $post_id,
    		'keterangan' => 'Video'
    	]);
    	return back();
    }

    public function removeVideo($post_id){
    	Whistlist::where('id_post', $post_id)->where('id_user', Auth::user()->id)->delete();
    	return back();
    }
}
