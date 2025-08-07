<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $data['profile'] = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('profile.index',$data);
    }

	public function getProfile()
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        if($getUser->role == "Super Admin" || $getUser->role == "Admin GSI"){
            $foto = "gsi-logo-transparent.png";
        }elseif($getUser->role == "Admin Vendor"){
            $getProfile = DB::table('vendor')->where('id', $getUser->id_vendor)->first();
            $foto = "/vendor/$getProfile->foto";  
        }
        $data = [
            'image' => $foto
        ];
        
    
        return response()->json($data);
    }
    public function updateProfile(Request $request)
    {
        $getProfile = DB::table('users')->where('id', Auth::user()->id)->first();
        $profile = User::find($getProfile->id);
        $profile->name = $request->input('name');
        if($request->input('password') != ""){
            $password = Hash::make($request->input('password'));
            $profile->password = $password;
        }
        if($profile->save()){
            return response()->json(['success'=>'Data Berhasil Diubah.']);
        }else {
            return response()->json(['error'=>'Data Gagal Diubah.']);
        }

        

    }
}
