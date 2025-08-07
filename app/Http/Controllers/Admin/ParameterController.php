<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Sensor;
use App\Models\Span;
use App\Models\Lokasi;
use App\Models\Parameter;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('parameter.index');
        }
    }

    public function sensor_client()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('parameter.detail');
        }
    }

    public function listParameter()
    {
        $data = Parameter::where('isDeleted', 0)->get();
        $list_data = new Collection;
        $i = 1;
        foreach($data as $ld){
            $list_data->push([
                'id' => $i,
                'nama_parameter' => $ld->nama_parameter,
                'batas_bawah' => $ld->batas_bawah,
                'batas_atas' => $ld->batas_atas,
                'satuan' => $ld->satuan,
                'action' => '<center><button type="button" data-id="'.$ld->id.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button></center>',
            ]);
            $i++;
        }
        return Datatables::of($list_data)->rawColumns(['action'])->make(true);
    }

    public function listParameterClient()
    {
        $id = Auth::user()->id;
        $list_data = new Collection;
        $i = 1;
        $getClient = DB::table('vendor')->where('isDeleted',0)->get();
        foreach($getClient as $gC){
            $getLokasi = DB::table('lokasi')->where('id_vendor',$gC->id)->where('isDeleted',0)->get();
            foreach($getLokasi as $gL){
                $getSpan = DB::table('span')->where('id_lokasi',$gL->id)->where('isDeleted',0)->get();
                foreach($getSpan as $gS){
                    $getSensor = DB::table('sensor')->where('isDeleted', 0)->where('id_span',$gS->id)->get();
                    foreach($getSensor as $ld){
                        $parameter = DB::table('parameter')->where('isDeleted',0)->where('id',$ld->id_parameter)->first();
                        $list_data->push([
                            'id' => $i,
                            'nama_client' => $gC->nama_vendor,
                            'lokasi' => $gL->nama_lokasi,
                            'span' => $gS->nama_span,
                            'nama_parameter' => $parameter->nama_parameter,
                            'sensorId' => $ld->nama_sensor,
                            'batas_bawah' => $ld->batas_bawah,
                            'batas_atas' => $ld->batas_atas,
                            'satuan' => $ld->satuan,
                            'action' => '<center><button style="width: 100%;" type="button" data-id="'.$ld->id.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button>&nbsp;<button style="width: 100%;" type="button" data-id="'.$ld->id.'" data-action="hapus" class="action btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i> Hapus</button></center>',
                        ]);
                        $i++;
                    }
                    
                }
            }
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
        //
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
    public function editData($id)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        
        $data = Sensor::where('id',$id)->first();
        $getParameter = Parameter::where('id',$data->id_parameter)->where('isDeleted',0)->first();
        $getSpan = Span::where('id',$data->id_span)->where('isDeleted',0)->first();
        $getLokasi = Lokasi::where('id',$getSpan->id_lokasi)->where('isDeleted',0)->first();
        $getClient = Vendor::where('id',$getLokasi->id_vendor)->where('isDeleted',0)->first();

        $data = [
            'id' => $data->id,
            'nama_client' => $getClient->nama_vendor,
            'lokasi' => $getLokasi->nama_lokasi,
            'span' => $getSpan->nama_span,
            'nama_sensor' => $getParameter->nama_parameter,
            'sensorId' => $data->nama_sensor,
            'batas_bawah' => $data->batas_bawah,
            'batas_atas' => $data->batas_atas,
            'satuan' => $data->satuan
        ];
        
    
        return response()->json($data);
    }


    public function edit($id)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        if($getUser->role == "Super Admin" || $getUser->role == "Admin GSI"){
            $data = Parameter::findorfail($id);
        }elseif($getUser->role == "Admin Vendor"){
            $data = Sensor::where('id',$id)->first();
            $getParameter = Parameter::where('id',$data->id_parameter)->where('isDeleted',0)->first();
            $getSpan = Span::where('id',$data->id_span)->where('isDeleted',0)->first();
            $getLokasi = Lokasi::where('id',$getSpan->id_lokasi)->where('isDeleted',0)->first();
            $data = [
                'id' => $data->id,
                'lokasi' => $getLokasi->nama_lokasi,
                'span' => $getSpan->nama_span,
                'nama_sensor' => $getParameter->nama_parameter,
                'sensorId' => $data->nama_sensor,
                'batas_bawah' => $data->batas_bawah,
                'batas_atas' => $data->batas_atas,
                'satuan' => $data->satuan
            ];
        }
        
    
        return response()->json($data);
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
        $getUser = User::where('id', Auth::user()->id)->first();
        if($getUser->role == "Super Admin" || $getUser->role == "Admin GSI"){
            $sensor = Parameter::find($id);
            $sensor->nama_parameter = $request->input('nama_parameter');
            $sensor->batas_atas = $request->input('batas_atas');
            $sensor->batas_bawah = $request->input('batas_bawah');
            $sensor->satuan = $request->input('satuan');
        }elseif($getUser->role == "Admin Vendor"){
            $checkData = Sensor::join('span','span.id','=','sensor.id_span')->join('lokasi','lokasi.id','=','span.id_lokasi')->where('sensor.id',$id)->where('sensor.isDeleted',0)->first();

            if($getUser->id_vendor == $checkData->id_vendor){
                $sensor = Sensor::find($id);
                $sensor->batas_atas = $request->input('batas_atas');
                $sensor->batas_bawah = $request->input('batas_bawah');
                $sensor->satuan = $request->input('satuan');
            }else{
                return response()->json(['error'=>'Akses ditolak.']);
            }
        }
        
        if($sensor->save()){
            return response()->json(['success'=>'Sensor Berhasil Diubah.']);
        }else{
            return response()->json(['error'=>'Sensor Gagal Diubah.']);
        }
    }
    public function updateData(Request $request, $id)
    {  
        $checkData = Sensor::join('span','span.id','=','sensor.id_span')->join('lokasi','lokasi.id','=','span.id_lokasi')->where('sensor.id',$id)->where('sensor.isDeleted',0)->first();
       
        $sensor = Sensor::find($id);
        $sensor->batas_atas = $request->input('batas_atas');
        $sensor->nama_sensor = $request->input('sensorId');
        $sensor->batas_bawah = $request->input('batas_bawah');
        $sensor->satuan = $request->input('satuan');
    
        
        if($sensor->save()){
            return response()->json(['success'=>'Sensor Berhasil Diubah.']);
        }else{
            return response()->json(['error'=>'Sensor Gagal Diubah.']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function deleteSensor($id)
    {
        $sensor = Sensor::find($id);
        $sensor->isDeleted = 1;
        if($sensor->save()){
            return response()->json(['success'=>'Sensor Berhasil Dihapus.']);
        }else{
            return response()->json(['error'=>'Sensor Gagal Dihapus.']);
        }
    }
	
    public function destroy($id)
    {
        //
    }
}
