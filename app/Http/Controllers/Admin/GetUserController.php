<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class GetUserController extends Controller
{
    function search(Request $request){
        if($request->get('query')){
            $query = $request->get('query');
            $data = User::join('profile', 'profile.id_user', '=', 'users.id')
            ->where('status_profile', 3)->where('profile.nama_lengkap', 'LIKE', "%{$query}%")
            ->select('id_user', 'nama_lengkap', 'email')
            ->get();
            $output = '';
            foreach($data as $row)
            {
                $output .= '
                <a href="#" id="datadrop" data-id="'. $row->id_user .'" class="dropdown-item"><li>' . $row->email . ' * ' . $row->nama_lengkap . '</li></a>';
            }
            $output .= '';
            echo $output;
        }
    }
}
