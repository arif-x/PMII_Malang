<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use App\Rayon;
use App\Provinsi;
use App\Koordinat;
use App\KoordinatKab;
use Http;

class WilayahController extends Controller
{
    public function provinsi(){
        $prov = Provinsi::pluck('name', 'id');
        return json_encode($prov);
    }

    public function kabupaten($prov_id){
    	$kabupaten = Kabupaten::where('provinsi_id', $prov_id)->pluck('name', 'id');
    	return json_encode($kabupaten);
    }

    public function kecamatan($kab_id){
    	$kecamatan = Kecamatan::where('kabupaten_id', $kab_id)->pluck('name', 'id');
    	return json_encode($kecamatan);
    }

    // public function koordinat($prov, $kab, $kec){        
    //     $kabData = Kabupaten::where('id', $kab)->value('id');
    //     $kab = substr($kabData, 2);

    //     $kecData = Kecamatan::where('id', $kec)->value('id');
    //     $kec = substr($kecData, 4);

    //     $koordinat = Koordinat::where('province_code', $prov)
    //     ->where('kabupaten_code', $kab) 
    //     ->where('kecamatan_code', $kec)        
    //     ->get(['kecamatan_name', 'lat', 'lng']);

    //     if(empty($koordinat)){
    //         $koordinat2 = KoordinatKab::where('kode', $prov.substr($kabData, 2))->pluck('lat', 'nama');
    //         return json_encode($koordinat2);        
    //     }
    //     return json_encode($koordinat);        

    // }

    public function rayon($kom_id){
    	$rayon = Rayon::where('id_komisariat', $kom_id)->pluck('nama_rayon', 'id_rayon');
    	return json_encode($rayon);
    }

    
}
