<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use Auth;
use Http;

class DataWilayahController extends Controller
{
    public function getProvince(){
    	$idProv = Profile::where('id_user', Auth::user()->id)->value('provinsi');

    	$apiURL = 'https://pro.rajaongkir.com/api/province';
        $postInput = [
            'key' => '7a16a47cf1776f1382860f44c9a9ef09',
            'id' => $idProv
        ];
        $headers = [

        ];

        $response = Http::withHeaders($headers)->get($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        return response()->json([$responseBody['rajaongkir']['results']]);
    }

    public function getCity(){
    	$idKota = Profile::where('id_user', Auth::user()->id)->value('kota_kabupaten');

        $apiURL = 'https://pro.rajaongkir.com/api/city';
        $postInput = [
            'key' => '7a16a47cf1776f1382860f44c9a9ef09',
            'id' => $idKota // Pakai Request
        ];
        $headers = [

        ];

        $response = Http::withHeaders($headers)->get($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        return response()->json([$responseBody['rajaongkir']['results']]);
    }

    public function getSubdistrict(){
    	$idKec = Profile::where('id_user', Auth::user()->id)->value('kecamatan');
        $apiURL = 'https://pro.rajaongkir.com/api/subdistrict';
        $postInput = [
            'key' => '7a16a47cf1776f1382860f44c9a9ef09',
            'id' => $idKec // Pakai Request
        ];
        $headers = [

        ];

        $response = Http::withHeaders($headers)->get($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        return response()->json([$responseBody['rajaongkir']['results']]);
    }
}
