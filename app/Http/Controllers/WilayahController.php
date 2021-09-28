<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use App\Rayon;

class WilayahController extends Controller
{
    public function kabupaten($prov_id){
    	$kabupaten = Kabupaten::where('province_id', $prov_id)->pluck('name', 'id');
    	return json_encode($kabupaten);
    }

    public function kecamatan($kab_id){
    	$kecamatan = Kecamatan::where('regency_id', $kab_id)->pluck('name', 'id');
    	return json_encode($kecamatan);
    }

    public function kelurahan($kec_id){
    	$kelurahan = Kelurahan::where('district_id', $kec_id)->pluck('name', 'id');
    	return json_encode($kelurahan);
    }

    public function rayon($kom_id){
    	$rayon = Rayon::where('id_komisariat', $kom_id)->pluck('nama_rayon', 'id_rayon');
    	return json_encode($rayon);
    }
}
