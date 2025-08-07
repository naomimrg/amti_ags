<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use DB;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            return view('user.index', $data);
        }
    }

    public function list()
    {
        $id = Auth::user()->id;

        $data = DB::table('users')->select('users.id','users.name','users.email','users.id_vendor','users.isDeleted','users.role')->join('vendor','vendor.id','=','users.id_vendor')->whereNotIn('role',['Super Admin','Admin GSI'])->where('users.isDeleted', 0)->where('vendor.isDeleted',0)->orderBy('users.id', 'DESC')->get();
        $list_data = new Collection;
        $i = 1;
        foreach($data as $ld){
            $getVendor = DB::table('vendor')->where('id',$ld->id_vendor)->where('isDeleted', 0)->first();
            $list_data->push([
                'id' => $i,
                'vendor' => $getVendor->nama_vendor,
                'nama' => $ld->name,
                'email' => $ld->email,
                'action' => '<center><button type="button" data-id="'.$ld->id.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button>&nbsp;<button type="button" data-id="'.$ld->id.'" data-action="hapus" class="action btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i> Hapus</button></center>',
            ]);
            $i++;
        }
        return Datatables::of($list_data)->rawColumns(['action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = "admin123";//DEFAULT PASSWORD USER
        $user = New User;
        $user->name = $request->input('name');
        $user->id_vendor = $request->input('id_vendor');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->role = 'Admin Vendor';
        
        if($user->save()){
            return response()->json(['success'=>'Account Berhasil Disimpan.']);
        }else{
            return response()->json(['success'=>'Account Gagal Disimpan.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getUser = DB::table('users')->where('id',$id)->first();
        $data = [
            "id" => $getUser->id,
            "name" => $getUser->name,
            "email" => $getUser->email,
            "id_vendor" => $getUser->id_vendor
        ];
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->id_vendor = $request->input('id_vendor');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
