<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Lokasi;
use App\Models\Span;
use App\Models\Sensor;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class VendorController extends Controller
{
    public function index($id){
        $getUser = DB::table('users')->where('id', Auth::user()->id)->first();
        $getVendor = DB::table('vendor')->where('id',$getUser->id_vendor)->where('isDeleted',0)->first();
        $getLokasi = DB::table('lokasi')->where('id_vendor',$getVendor->id)->where('isDeleted',0)->where('slug',$id)->first();
        $data['vendor'] = $getVendor;
        $data['lokasi'] = $getLokasi;
        return view('admin_vendor.dashboard.index',$data);
    }

    public function liveSensor($id){
        $getUser = DB::table('users')->where('id', Auth::user()->id)->first();
        $getLokasi = DB::table('lokasi')->where('id_vendor',$getUser->id_vendor)->where('isDeleted',0)->where('slug',$id)->first();
        $getSpan = DB::table('span')->where('id_lokasi',$getLokasi->id)->where('isDeleted',0)->orderBy('id', 'DESC')->get();
        $data['lokasi'] = $getLokasi;
        $data['span'] = $getSpan;
        return view('admin_vendor.live_sensor.index',$data);
    }
    public function dataSensor($id, $spanId){
        $getUser = DB::table('users')->where('id', Auth::user()->id)->first();
        $getLokasi = DB::table('lokasi')->where('id_vendor',$getUser->id_vendor)->where('isDeleted',0)->where('slug',$id)->first();
        $getSpan = DB::table('span')->where('id_lokasi',$getLokasi->id)->where('id',$spanId)->where('isDeleted',0)->first();
        $data['lokasi'] = $getLokasi;
        $data['span'] = $getSpan;
        return view('admin_vendor.live_sensor.detail',$data);
    }

    public function listLokasiSpan($id)
    {
        $getLokasi = DB::table('lokasi')->where('slug',$id)->where('isDeleted',0)->first();
        $getSpan = DB::table('span')->where('id_lokasi',$getLokasi->id)->where('isDeleted',0)->orderBy('id', 'ASC')
        ->get();
        $data = array();
        $no = 1;
        $to_date = date('Y-m-d H:i:s');
        $from_date = date('Y-m-d H:i:s', strtotime('-3 second'));

        foreach ($getSpan as $key) {
            $countSensor = Sensor::where('id_span',$key->id)->where('isDeleted',0)->count();
            $good = 0;
            $warning = 0;
            $critical = 0;
            $offline = 0;
            if($countSensor > 0){
                $getSensor = Sensor::where('id_span',$key->id)->where('isDeleted',0)->get();
                foreach($getSensor as $gs){
                    $batas_atas = $gs->batas_atas;
                    $batas_bawah = $gs->batas_bawah;
                    $getValue = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(\DB::raw('time'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->count();
                    if($getValue > 0){

                        $getValue = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(\DB::raw('DATE(time)'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->get();
                        foreach($getValue as $gV){
                            $value = $gV->value;
                            if($value == 0 || $value == NULL){
                                $offline++;
                            }elseif($value < $batas_bawah){
                                $good++;
                            }elseif($value > $batas_bawah && $value < $batas_atas){
                                $warning++;
                            }elseif($value > $batas_atas){
                                $critical++;
                            }else{
                                $offline++;
                            }
                        }

                    }else{
                        $offline++;
                    }

                }
                $rules = $countSensor / 2;
                //echo "$key->nama_span Rules = $rules , Good = $good , Warning = $warning , Critical = $critical, Offline = $offline \n";
                if($offline > 0){
                    $status = "black-pin";
                }elseif($critical > 0 || $warning >= $rules){
                    $status = "red-pin";
                }elseif($warning > 0){
                    $status = "yellow-pin";
                }elseif($good == $countSensor){
                    $status = "green-pin";
                }
            }else{
                $status = "black-pin";
            }

            $data[] = [
                'id' => $key->id,
                'no' => $no,
                'nama_span' => $key->nama_span,
                'y' => $key->y_position,
                'x' => $key->x_position,
                'status' => $status];
            $no++;
        }
        return response()->json(['items' => $data]);
    }
	public function listSpanLokasi($id){
        $getLokasi = DB::table('lokasi')->where('slug',$id)->where('isDeleted',0)->first();
        $getSpan = DB::table('span')->where('id_lokasi',$getLokasi->id)->where('isDeleted',0)->orderBy('id', 'ASC')->get();
        $data = array();
        $no = 1;

        foreach ($getSpan as $key) {
            $data[] = [
                'id' => $key->id,
				'foto' => $key->foto,
                'no' => $no,
                'nama_span' => $key->nama_span,
                'y' => $key->y_position,
                'x' => $key->x_position];
            $no++;
        }
        return response()->json(['items' => $data]);
    }
    public function listLoc()
    {
        $getUser = DB::table('users')->where('id', Auth::user()->id)->first();
        $getLokasi = DB::table('lokasi')->where('id_vendor',$getUser->id_vendor)->where('isDeleted',0)->get();
        $data = array();
        foreach ($getLokasi as $key) {
            if ($key->foto != "" || $key->foto != NULL) {
                $image = $key->foto;
            }else {
                $image = 'default.jpg';
            }
            $data[] = [
                'id' => $key->id,
                'image' => $image,
                'nama_lokasi' => $key->nama_lokasi,
                'slug' => $key->slug,
                'long' => $key->long,
                'lat' => $key->lat,
                'created_at' => date('D,j M Y',strtotime($key->created_at))];
        }
        return response()->json(['items' => $data]);
    }

    public function sensor()
    {
        return view('admin_vendor.sensor.index');
    }
    public function listSensor()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();

        $getLokasi = DB::table('lokasi')->where('id_vendor',$getUser->id_vendor)->where('isDeleted',0)->get();
        $list_data = new Collection;
        $i = 1;
        foreach($getLokasi as $gL){
            $getSpan = DB::table('span')->where('id_lokasi',$gL->id)->where('isDeleted',0)->get();
            foreach($getSpan as $gS){
                $getSensor = DB::table('sensor')->where('isDeleted', 0)->where('id_span',$gS->id)->get();
                foreach($getSensor as $ld){
                    $parameter = DB::table('parameter')->where('isDeleted',0)->where('id',$ld->id_parameter)->first();
                    $list_data->push([
                        'id' => $i,
                        'lokasi' => $gL->nama_lokasi,
                        'span' => $gS->nama_span,
                        'nama_parameter' => $parameter->nama_parameter,
                        'sensorId' => $ld->nama_sensor,
                        'batas_bawah' => $ld->batas_bawah,
                        'batas_atas' => $ld->batas_atas,
                        'satuan' => $ld->satuan,
                        'action' => '<center><button type="button" data-id="'.$ld->id.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button></center>',
                    ]);
                    $i++;
                }

            }
        }
        return Datatables::of($list_data)->rawColumns(['action'])->make(true);
    }
    public function editSpan($id)
    {
        $span = Span::find($id);
        echo json_encode($span);
    }

    public function updateSpan(Request $request)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        $id = $request->input('id_span');
        $checkData = Span::join('lokasi','lokasi.id','=','span.id_lokasi')->where('span.id',$id)->where('span.isDeleted',0)->first();
        if($getUser->id_vendor == $checkData->id_vendor){
            $span = Span::find($id);
            $span->nama_span = $request->input('nama_span');

            if($request->hasFile('foto')){
                $validation = Validator::make($request->all(), [
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
                ]);
                if($validation->passes()) {
                    $image = $request->file('foto');
                    $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('assets/img/span'), $new_name);
                    $span->foto = $new_name;
                }
            }
            if($span->save()){
                return response()->json(['success'=>'Span Berhasil Diubah.']);
            }else {
                return response()->json(['error'=>'Span Gagal Diubah.']);
            }
        }else{
            return response()->json(['error'=>'Akses ditolak.']);
        }

    }
    public function deleteSpan($id)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        $checkData = Span::join('lokasi','lokasi.id','=','span.id_lokasi')->where('span.id',$id)->where('span.isDeleted',0)->first();
		if($getUser->id_vendor == ""){
			$span = Span::find($id);
            $span->isDeleted=1;
            if($span->save()){
                return response()->json(['success'=>'Span Berhasil Dihapus.']);
            }else{
                return response()->json(['error'=>'Span Gagal Dihapus.']);
            }
		}elseif($getUser->id_vendor == $checkData->id_vendor){
			$span = Span::find($id);
            $span->isDeleted=1;
            if($span->save()){
                return response()->json(['success'=>'Span Berhasil Dihapus.']);
            }else{
                return response()->json(['error'=>'Span Gagal Dihapus.']);
            }
		}else{
            return response()->json(['error'=>'Akses ditolak.']);
        }
        /*if($getUser->id_vendor == $checkData->id_vendor){
            $span = Span::find($id);
            $span->isDeleted=1;
            if($span->save()){
                return response()->json(['success'=>'Span Berhasil Dihapus.']);
            }else{
                return response()->json(['error'=>'Span Gagal Dihapus.']);
            }
        }else{
            return response()->json(['error'=>'Akses ditolak.']);
        }*/
    }

    public function chartList()
    {
        $response = array();
        $dataSensor = array();
        $dateTime = array();
        $id = $_GET['id_sensor'];
        $to_date = date('Y-m-d H:i:s');
        $from_date = date('Y-m-d H:i:s', strtotime('-3 second'));

        $idUser = Auth::user()->id;
        $getParameter = Sensor::where('id',$id)->first();

        $countValue = DB::table('log_data')->where('id_sensor',$id)->whereBetween(\DB::raw('time'), [$from_date, $to_date])->orderBy('time','DESC')->count();
        if($countValue > 0){
            $getValue = DB::table('log_data')->where('id_sensor',$id)->whereBetween(\DB::raw('time'), [$from_date, $to_date])->orderBy('time','DESC')->first();
            $value = $getValue->value;
        }else{
            $value = 0;
        }

        $batas_bawah = $getParameter->batas_bawah;
        $batas_atas = $getParameter->batas_atas;
        if($value == 0 || $value == NULL){
            $status = 'black';
        }elseif($value < $batas_bawah){
            $status = 'green';
        }elseif($value > $batas_bawah && $value < $batas_atas){
            $status = 'orange';
        }elseif($value > $batas_atas){
            $status = 'red';
        }else{
            $status = 'black';
        }
        $response = array(
            "satuan" => $getParameter->satuan,
            "status" => $status,
            "batas_atas" => $getParameter->batas_atas,
            "batas_bawah" => $getParameter->batas_bawah,
            "value" => $value,
            'datetime' => date('H:i:s'),

        );
        echo json_encode($response);
    }
    public function natFreqChartList(Request $request)
    {
        $stationId = $request->query('station_id');
        $date = $request->query('date'); 
    
        if (!$stationId || !$date) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }
    
        $natFreqData = DB::table('nat_freq')
            ->select(
                'time',
                DB::raw('CASE WHEN axis = \'X\' THEN value ELSE NULL END as x'),
                DB::raw('CASE WHEN axis = \'Y\' THEN value ELSE NULL END as y'),
                DB::raw('CASE WHEN axis = \'Z\' THEN value ELSE NULL END as z')
            )
            ->where('station_id', $stationId)
            ->whereDate('time', $date)
            ->orderBy('time', 'ASC')
            ->get();
    
        $response = [
            'time' => $natFreqData->pluck('time'),
            'x' => $natFreqData->pluck('x'),
            'y' => $natFreqData->pluck('y'),
            'z' => $natFreqData->pluck('z'),
        ];
    
        return response()->json($response);
    }

}
