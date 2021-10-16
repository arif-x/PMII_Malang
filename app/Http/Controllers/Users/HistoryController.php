<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Video;
use App\Modul;
use App\History;
use Auth;

class HistoryController extends Controller
{
    public function index(){
    	$history = History::join('users', 'users.id', '=', 'history.id_user')
    	->where('id_user', Auth::user()->id)->get();

    	return view('users.history', ['hist' => $history]);
    }
}
