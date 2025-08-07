<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sensor;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('dashboard.index');
        }
    }

    public function listLokasi()
    {
        $getLokasi = DB::table('lokasi')->select('lokasi.*', 'vendor.nama_vendor','vendor.foto as foto_vendor','vendor.slug as slug_vendor')->join('vendor','vendor.id','=','lokasi.id_vendor')->where('lokasi.isDeleted',0)->where('vendor.isDeleted',0)->get();
        $data = array();
        foreach ($getLokasi as $key) {
            if ($key->foto != "" || $key->foto != NULL) {
                $image = $key->foto;
            }else {
                $image = 'default.jpg';
            }
            $status = "green";
            $countSpan = 0;
            $getSpan = DB::table('span')->where('id_lokasi',$key->id)->where('isDeleted',0)->orderBy('id', 'ASC')->get();
            $to_date = date('Y-m-d H:i:s');
            $from_date = date('Y-m-d H:i:s', strtotime('-50 second'));
            $goodSpan = 0;
            $warningSpan = 0;
            $criticalSpan = 0;
            $offlineSpan = 0;
            foreach ($getSpan as $keys) {
                $countSensor = Sensor::where('id_span',$keys->id)->where('isDeleted',0)->count();
                $good = 0;
                $warning = 0;
                $critical = 0;
                $offline = 0;
                if($countSensor > 0){
                    $getSensor = Sensor::where('id_span',$keys->id)->where('isDeleted',0)->get();
                    foreach($getSensor as $gs){
                        $batas_atas = $gs->batas_atas;
                        $batas_bawah = $gs->batas_bawah;
                        $getValue = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(DB::raw('time'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->count();
                        if($getValue > 0){
                            $gV = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(DB::raw('DATE(time)'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->first();
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
                        }else{
                            $offline++;
                        }

                    }
                    $rules = $countSensor / 2;

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

                if($status == "red-pin"){
                    $criticalSpan++;
                }elseif($status == "orange-pin"){
                    $warningSpan++;
                }elseif($status == "green-pin"){
                    $goodSpan++;
                }elseif($status == "black-pin"){
                    $offlineSpan++;
                }
                $countSpan++;
            }
            $rulesSpan = $countSpan/2;
            if($countSpan > 0){
                if($offlineSpan > 0){
                    $statusSpan = "black";
                }elseif($criticalSpan > 0 || $warningSpan >= $rulesSpan){
                    $statusSpan = "red";
                }elseif($warningSpan > 0){
                    $statusSpan = "yellow";
                }elseif($goodSpan == $countSpan){
                    $statusSpan = "green";
                }
            }else{
                $statusSpan = "black";
            }


            $data[] = [
                'id' => $key->id,
                'nama_vendor' => $key->nama_vendor,
                'slug_vendor' => $key->slug_vendor,
                'image' => $image,
                'nama_lokasi' => $key->nama_lokasi,
                'slug' => $key->slug,
                'long' => $key->long,
                'lat' => $key->lat,
                'status' => $statusSpan,
                'created_at' => date('D,j M Y',strtotime($key->created_at))];

        }
        return response()->json(['items' => $data]);
    }

    public function listLokasiSSE()
    {
        $response = new StreamedResponse(function () {
            $lastQueryTime = now();
            $isOpenConnection = true;

            while (true) {
                $currentTime = now();
                if ($currentTime->diffInSeconds($lastQueryTime) >= 20 || $isOpenConnection) {
                    $to_date = now()->toDateTimeString();
                    $from_date = now()->subSeconds(3)->toDateTimeString();

                    $locations = DB::table('lokasi')
                        ->leftJoin('span', function($join) {
                            $join->on('lokasi.id', '=', 'span.id_lokasi')
                                ->where('span.isDeleted', 0);
                        })
                        ->leftJoin('sensor', function($join) {
                            $join->on('span.id', '=', 'sensor.id_span')
                                ->where('sensor.isDeleted', 0);
                        })
                        ->join('vendor', 'lokasi.id_vendor', '=', 'vendor.id')
                        ->select(
                            'lokasi.id',
                            'lokasi.nama_lokasi',
                            'lokasi.slug',
                            'lokasi.long',
                            'lokasi.lat',
                            'vendor.nama_vendor',
                            'vendor.slug as slug_vendor',
                            'lokasi.foto',
                            DB::raw("(
                                SELECT value
                                FROM log_data
                                WHERE id_sensor = sensor.id
                                AND time BETWEEN '$from_date' AND '$to_date'
                                ORDER BY id DESC
                                LIMIT 1
                            ) as log_data_value"),
                            'sensor.batas_bawah',
                            'sensor.batas_atas',
                            'lokasi.created_at',
                        )
                        ->where('lokasi.isDeleted', 0)
                        ->where('vendor.isDeleted', 0)
                        ->get()
                        ->groupBy('id');

                    $data = [];
                    foreach ($locations as $locationId => $location) {
                        $countSensor = $location->count();
                        $rules = $countSensor/2;

                        $countOffline = $location->filter(function ($item) {
                            return is_null($item->log_data_value) || $item->log_data_value === 0;
                        })->count();

                        $countCritical = $location->where('log_data_value', '>', 'batas_atas')->count();
                        $countWarning = $location
                            ->where('log_data_value', '>', 'batas_bawah')
                            ->where('log_data_value', '<', 'batas_atas')
                            ->count();
                        $countGood = $location->where('log_data_value', '<', 'batas_bawah')->count();

                        $statusSpan = '';
                        if ($countOffline > 0) {
                            $statusSpan = 'black';
                        } else if ($countCritical > 0 || $countWarning >= $rules) {
                            $statusSpan = 'red';
                        } elseif ($countWarning > 0) {
                            $statusSpan = 'yellow';
                        } elseif($countGood == $countSensor){
                            $statusSpan = "green";
                        }

                        $data[] = [
                            'id' => $locationId,
                            'nama_vendor' => $location->first()->nama_vendor,
                            'slug_vendor' => $location->first()->slug_vendor,
                            'image' => $location->first()->foto ?? 'default.jpg',
                            'nama_lokasi' => $location->first()->nama_lokasi,
                            'slug' => $location->first()->slug,
                            'long' => $location->first()->long,
                            'lat' => $location->first()->lat,
                            'status' => $statusSpan,
                            'created_at' => date('D,j M Y',strtotime($location->first()->created_at))];
                    }
                }

                if ($currentTime->diffInSeconds($lastQueryTime) >= 20 || $isOpenConnection) {
                    $isOpenConnection = false;
                    $lastQueryTime = now();
                    $data = json_encode(['items' => $data]);
                    echo "data: $data\n\n";
                } else {
                    echo "data: empty\n\n";
                }

                ob_flush();
                flush();

                sleep(1);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }
}
