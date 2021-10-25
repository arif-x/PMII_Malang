<?php

namespace App\Http\Controllers\Admin\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id){
        return view('admin.kader-detail', compact('id'));
    }
}
