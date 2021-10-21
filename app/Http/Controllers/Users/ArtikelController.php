<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;

class ArtikelController extends Controller
{
	public function getJson(){
		$apiURL = 'http://api_sahabat.sahabat.or.id/api/Artikel';
		$postInput = [
			'TOKEN' => 'yogiganteng',
			'page' => 1,
		];
		$headers = [
            
		];

		$response = Http::withHeaders($headers)->post($apiURL, $postInput);
		$responseBody = json_decode($response->getBody(), true);
		
        return view('test', ['cuk' => $responseBody]); // body response	
    }
}
