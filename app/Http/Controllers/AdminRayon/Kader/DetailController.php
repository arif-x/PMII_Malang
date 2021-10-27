<?php

namespace App\Http\Controllers\AdminRayon\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id){
        return view('rayon.kader-detail', compact('id'));
    }
}
