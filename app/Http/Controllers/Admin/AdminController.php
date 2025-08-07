<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vendor'] = DB::table('vendor')->where('isDeleted',0)->get();
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('admin.index', $data);
        }
    }

    public function list()
    {
        $data = DB::table('users')
            ->select(
                'users.id',
                'users.role',
                'users.name',
                'users.email',
            )
            ->whereIn('role', ['Super Admin','Admin GSI'])
            ->where('users.isDeleted', 0)
            ->orderBy('users.id', 'DESC')
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function($data) {
                $actionBtn = '<center><button id="btn-edit" type="button" data-id="'.$data->id.'" data-name="'.$data->name.'" data-role="'.$data->role.'" data-email="'.$data->email.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button>&nbsp;<button type="button" id="btn-delete" data-id="'.$data->id.'" data-action="hapus" class="action btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i> Hapus</button></center>';

                if ($data->id === Auth::user()->id) {
                    $actionBtn = '';
                }

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $password = "admin123";
        $user = New User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->role = $request->input('role');

        if($user->save()){
            return response()->json(['success'=>'Account Berhasil Disimpan.']);
        }else{
            return response()->json(['success'=>'Account Gagal Disimpan.']);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->email = $request->input('email');

        if($request->input('password') != ""){
            $user->password = Hash::make($request->input('password'));
        }

        if($user->save()){
            return response()->json(['success'=>'Account Berhasil Diubah.']);
        }else{
            return response()->json(['error'=>'Account Gagal Diubah.']);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->isDeleted = 1;
        if($user->save()){
            return response()->json(['success'=>'Account Berhasil Dihapus.']);
        }else{
            return response()->json(['error'=>'Account Gagal Dihapus.']);
        }
    }
}
