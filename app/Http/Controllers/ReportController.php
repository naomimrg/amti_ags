<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Sensor;
use App\Models\Lokasi;
use App\Models\Span;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;
use DateInterval;
use DatePeriod;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $getUser = DB::table('users')->where('id', Auth::user()->id)->first();
        if($getUser->role == "Admin GSI" || $getUser->role == "Super Admin"){
            $data['client'] = DB::table('vendor')->where('isDeleted',0)->get();
            return view('admin_vendor.report.report',$data);
        }else{
            $getVendor = DB::table('vendor')->where('id',$getUser->id_vendor)->where('isDeleted',0)->first();
            $data['lokasi']  = DB::table('lokasi')->where('id_vendor',$getVendor->id)->where('isDeleted',0)->get();
            return view('admin_vendor.report.index',$data);
        }
    }

    public function listReport()
    {
        $fromdate = date('Y-m-d 00:00:00', strtotime($_GET['from_date']));
        $todate = date('Y-m-d 23:59:59', strtotime($_GET['to_date']));
        $id_sensor = $_GET['id_sensor'];
        $draw = $_GET['draw'];
        $row = $_GET['start'];
        $rowperpage = $_GET['length'];
        $columnIndex = $_GET['order'][0]['column'];
        $columnName = 'time';
        $columnSortOrder = $_GET['order'][0]['dir'];
        $searchValue = $_GET['search']['value'];

        $countDataAll = DB::table('log_data')
            ->where('id_sensor',$id_sensor)
            ->whereBetween('time', [$fromdate, $todate])
            ->count();
        $totalRecords = $countDataAll;
        $totalRecordwithFilter = $totalRecords;

        ## Fetch records
        $getDataAll = DB::table('log_data')
            ->where('id_sensor',$id_sensor)
            ->whereBetween('time', [$fromdate, $todate])
            ->orderBy('time', $columnSortOrder)
            ->limit($rowperpage)
            ->offset($row)
            ->get();

        $data = array();
        $id=1;
        foreach($getDataAll as $gD){
            $data[] = array(
                "datetime"=>date('Y-m-d H:i:s', strtotime($gD->time)),
                "value"=>$gD->value
            );
            $id++;
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function chartList()
    {
        $response = array();
        $dataSensor = array();
        $dateTime = array();
        $id = $_GET['id_sensor'];
        if($_GET['from_date'] == ""){
            $from_date = date('Y-m-d', strtotime('-1 day'));
        } else {
            $from_date = date('Y-m-d', strtotime($_GET['from_date']));
        }

        if($_GET['to_date'] == ""){
            $to_date = date('Y-m-d');
        } else {
            $to_date = date('Y-m-d', strtotime($_GET['to_date']));
        }

        $idUser = Auth::user()->id;

        $getParameter = Sensor::where('id',$id)->first();
        $begin = new DateTime($from_date);
        $end = new DateTime($to_date);
        $end->modify('+1 day');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            $mewDate = $dt->format("Y-m-d");
            for($i=0;$i<24;$i++){
                $date = $mewDate.' '.$i.':00:00';
                $newFromDate = date('Y-m-d H:i:s', strtotime($date));
                $newToDate =  date("Y-m-d H:i:59", strtotime("59 minute", strtotime($newFromDate)));

                $datas = DB::table('log_data')->select(DB::raw('avg(value) as value'))->where('id_sensor',$id)->whereBetween('time', [$newFromDate, $newToDate])->get();
                foreach($datas as $data){
                    $response[] = array(
                        "batas_atas" => $getParameter->batas_atas,
                        "batas_bawah" => $getParameter->batas_bawah,
                        "tahun" => date('Y', strtotime($from_date)),
                        "bulan" => date('m', strtotime($newFromDate)),
                        "hari" => date('d', strtotime($newFromDate)),
                        "jam" => date('H', strtotime($newFromDate)),
                        "menit" => date('i', strtotime($newFromDate)),
                        "detik" => date('s', strtotime($newFromDate)),
                        "value" => floatVal($data->value),
                        'datetime' => $newFromDate
                    );
                }


            }
        }

        echo json_encode($response);
    }

	public function chartNat()
    {
        $response = array();
        $dataSensor = array();
        $dateTime = array();
        $id = $_GET['id_span'];
        $getStationId = DB::table('span')->where('id', $id)->where('isDeleted',0)->first();
        $stationId = $getStationId->stationId;
        if($_GET['from_date'] == ""){
            $from_date = date('Y-m-d', strtotime('-1 day'));
        } else {
            $from_date = date('Y-m-d', strtotime($_GET['from_date']));
        }

        if($_GET['to_date'] == ""){
            $to_date = date('Y-m-d');
        } else {
            $to_date = date('Y-m-d', strtotime($_GET['to_date']));
        }

        $idUser = Auth::user()->id;
        $begin = new DateTime($from_date);
        $end = new DateTime($to_date);
        $end->modify('+1 day');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            $mewDate = $dt->format("Y-m-d");
            for($i=0;$i<24;$i++){
                $date = $mewDate.' '.$i.':00:00';

                $datas = DB::table('nat_freq')->where('station_id',$stationId)->where('time', $date)->sum('value');
                    $response[] = array(
                        "date" => $date,
                        "value" => $datas
                    );
            }
        }

        echo json_encode($response);
    }

    function downloadExcel()
    {
        $idSensor = $_GET['id_sensor'];
        $getSensor = DB::table('sensor')->where('id', $idSensor)->first();
        $getSpan = DB::table('span')->where('id', $getSensor->id_span)->first();
        $getLokasi = DB::table('lokasi')->where('id', $getSpan->id_lokasi)->first();
        $fromdate =  date('Y-m-d', strtotime($_GET['from_date']));
        $todate =  date('Y-m-d', strtotime($_GET['to_date']));
        $name = 'Report '.$getLokasi->nama_lokasi.' '.$getSpan->nama_span.' Sensor '.$getSensor->nama_sensor.' tanggal '.$fromdate.'-'.$todate.'.xlsx';
        return Excel::download(new ReportExport($idSensor, $fromdate, $todate), $name);
    }
}
