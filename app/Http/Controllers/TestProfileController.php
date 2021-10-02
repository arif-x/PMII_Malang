<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komisariat;
use App\Provinsi;
use App\Profile;
use App\Pekerjaan;
use App\Kaderisasi;
use Auth;

class TestProfileController extends Controller
{
    public function index(){
    	$provinsi = Provinsi::pluck('name', 'id');
    	$komisariat = Komisariat::pluck('nama_komisariat', 'id_komisariat');
    	$pekerjaan = Pekerjaan::pluck('pekerjan', 'id_pekerjan');
    	return view('profile', compact('provinsi', 'komisariat', 'pekerjaan'));
    }
}
