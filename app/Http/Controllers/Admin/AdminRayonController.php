<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminRayon;
use DataTables;

class AdminRayonController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = AdminRayon::join('profile', 'profile.id_user', '=', 'users.id')->where('level', 2)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.admin-rayon');
    }

    public function tambah($admin_rayon_id){
        AdminRayon::where('id', $admin_rayon_id)->update([
            'level' => 2
        ]);
        return response()->json(['success'=>'Admin Rayon Diedit.']);
    }

    public function hapus($admin_rayon_id){
        AdminRayon::where('id', $admin_rayon_id)->update([
            'level' => 1
        ]);
        return response()->json(['success'=>'Admin Rayon Diedit.']);
    } 
}
