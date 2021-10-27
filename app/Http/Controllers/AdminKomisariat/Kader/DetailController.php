<?php

namespace App\Http\Controllers\AdminKomisariat\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id){
        return view('komisariat.kader-detail', compact('id'));
    }
}
