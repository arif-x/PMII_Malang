<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\AdminKomisariat;

class AdminKomisariatController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = AdminKomisariat::join('profile', 'profile.id_user', '=', 'users.id')->where('level', 3)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.admin-komisariat');
    }

    public function tambah($admin_kom_id){
        AdminKomisariat::where('id', $admin_kom_id)->update([
            'level' => 3
        ]);
        return response()->json(['success'=>'Admin Komisariat Diedit.']);
    }

    public function hapus($admin_kom_id){
        AdminKomisariat::where('id', $admin_kom_id)->update([
            'level' => 1
        ]);
        return response()->json(['success'=>'Admin Komisariat Diedit.']);
    } 
}
