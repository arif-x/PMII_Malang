<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modul;

class PDFViewerController extends Controller
{
    public function index($post, $format){
    	$modul = Modul::where('post', $post)->where('format_post', $format)->get();
    	return view('users.pdf', ['modules' => $modul]);
    }
}
