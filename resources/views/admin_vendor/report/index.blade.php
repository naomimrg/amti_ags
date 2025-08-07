@extends('layouts.admin')
@section('title', 'Report')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ url('/assets') }}/css/dataTables.bootstrap4.min.css">
 <style>
.form-group{
    margin-bottom: 10px;
    color: black;
}
.form-control{
    color: black;
}
</style>

@endsection
@section('content')
        
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="black-color">Report</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card mb-3" style="padding:10px 0px 0px 10px;">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <select id="id_lokasi" class="form-control select2" name="id_lokasi" data-placeholder="id_lokasi" required="required">
                                                    <option value="">-- Pilih Lokasi --</option>
                                                    @foreach($lokasi as $data)
                                                    <option value="{{$data->slug}}">{{$data->nama_lokasi}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <select id="id_span" class="form-control select2" name="id_span" data-placeholder="id_span" required="required">
                                                    <option value="">-- Pilih Span --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <select id="id_sensor" class="form-control select2" name="id_sensor" data-placeholder="id_sensor" required="required">
                                                    <option value="">-- Pilih Sensor --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input class="form-control" name="from_date" type="date" value="" id="from_date" placeholder="Dari tanggal"/>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input class="form-control" name="to_date" type="date" value="" id="to_date" placeholder="Sampai tanggal" />
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <button class="action btn btn-primary waves-effect waves-light" type="submit" id="search-data" onclick="searchData()">Cari</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <p style="color:black;font-weight:bold;" id="resultfilter"></p>
                        <div id="downloadBtn"></div>

                            <div class="col-xl-12 col-lg-12 mb-2">
                                <div class="card">
                                    <div class="card-block">
                                    <div id="container-chart" style=" width: 100%;height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 mb-2" id="nat-freq-box" style="display:;">
                                <div class="card">
                                    <div class="card-block">
                                    <div id="nat-freq" style=" width: 100%;height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card" style="padding:10px">
                                    <div class="table-body">
                                        <div class="table-responsive" style="overflow-x: hidden;">
                                            <table id="table-report" class="table table-bordered" style="font-size: 11px;">
                                                <thead style="background: #0ec8cf;color: white;">
                                                    <tr class=" text-center">
                                                        <th style="color: white;">Waktu</th>
                                                        <th style="color: white;">Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- / Content -->
@endsection
@section('script')
<script src="{{ url('/assets') }}/js/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/assets') }}/js/datatables/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/rangeSelector.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    $("#id_lokasi").change(function(){
	var id_lokasi = $(this).val();
		$.ajax({
			type: "get",
            url: "{{ url('/listSpanLokasi/') }}/"+id_lokasi,
            cache: false, 
            success: function(data){
                if(data){
                    $('#id_span').empty();
                    $('#id_sensor').empty();
                    //$("#downloadBtn").html('');
                    $('#id_sensor').append('<option hidden>-- Pilih Sensor --</option>'); 
                    $('#id_span').append('<option hidden>-- Pilih Span --</option>'); 
                    $.each(data.items, function(index, item) {
                        $("#id_span").append('<option value="'+item.id+'">'+item.nama_span+'</option>');
                    });  
                }else{
                    $('#id_span').empty();
                    $('#id_sensor').empty();
                    //$("#downloadBtn").html('');
                    $('#id_sensor').append('<option hidden>-- Pilih Sensor --</option>'); 
                }
                      
            }
		});
	});

    $("#id_span").change(function(){
	var id_span = $(this).val();
		$.ajax({
			type: "get",
            url: "{{ url('/listSensor/') }}/"+id_span,
            cache: false, 
            success: function(data){
                if(data){
                    $('#id_sensor').empty();
                    $('#id_sensor').append('<option hidden>-- Pilih Sensor --</option>'); 
                    $.each(data.items, function(index, item) {
                        $("#id_sensor").append('<option value="'+item.id+'">'+item.sensor_id+'</option>');
                    });  
                }else{
                    $('#id_sensor').empty();
                }
                      
            }
		});
	});

    function searchData(){
		from_date = $('#from_date').val();
		to_date = $('#to_date').val();
		id_sensor = $('#id_sensor').val();
        id_span = $('#id_span').val();
        $('#table-report').DataTable().destroy();
        $('#table-report').DataTable({
            processing: true,
            serverSide: true,
            serverMethod : 'GET',
            ajax: "{{ url('/report/list-report') }}?id_sensor="+id_sensor+'&from_date='+from_date+'&to_date='+to_date,
            columns: [
                {data: 'datetime', name: 'datetime'},
                {data: 'value', name: 'value'}
            ]
        });

       
        am4core.ready(function() {
            var dataC = [];
            var i;
            $.ajax({
                url: "{{ url('/report/chartList') }}?id_sensor="+id_sensor+'&from_date='+from_date+'&to_date='+to_date,
                dataType: "json",
                async: false,
                type: "GET",
                success: function(data) {
                    $.each(data, function(index, item) {
                        var newDate = item.datetime;
                        dataC.push({
                            date: new Date(newDate),
                            value: item.value,
                            batas_bawah: item.batas_bawah,
                            batas_atas: item.batas_atas,
                        })
                    });
                }
            });
            am4core.useTheme(am4themes_animated);
            
            var chart = am4core.create("container-chart", am4charts.XYChart);
            chart.data = dataC;
            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.groupData = true;
        
            dateAxis.groupIntervals.setAll([
                {
                    timeUnit: "minute",
                    count: 1
                },
                {
                    timeUnit: "hour",
                    count: 1
                },
                {
                    timeUnit: "day",
                    count: 1
                },
                { 
                    timeUnit: "day", 
                    count: 1 },
                {
                    timeUnit: "week",
                    count: 1
                },
                {
                    timeUnit: "month",
                    count: 1
                },
                {
                    timeUnit: "year",
                    count: 1
                },
            ]);
        
            var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis1.title.text = "Sensor";
            valueAxis1.renderer.grid.template.disabled = true;
            
            var series1 = chart.series.push(new am4charts.LineSeries());
            series1.dataFields.valueY = "value";
            series1.dataFields.dateX = "date";
            series1.name = "Sensor";
            series1.strokeWidth = 2;
            series1.tensionX = 0.7;
            series1.yAxis = valueAxis1;
            series1.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";
            
            var bullet1 = series1.bullets.push(new am4charts.CircleBullet());
            bullet1.circle.radius = 3;
            bullet1.circle.strokeWidth = 2;
            bullet1.circle.fill = am4core.color("#fff");
            
            var series2 = chart.series.push(new am4charts.LineSeries());
            series2.dataFields.valueY = "batas_bawah";
            series2.dataFields.dateX = "date";
            series2.name = "Ambang Batas Bawah";
            series2.yAxis = valueAxis1;
            series2.stroke = am4core.color("#000000");

            
            /*var bullet2 = series2.bullets.push(new am4charts.CircleBullet());
            bullet2.circle.radius = 1;
            bullet2.circle.strokeWidth = 1;
            bullet2.circle.fill = am4core.color("#fff");*/
            
            var series3 = chart.series.push(new am4charts.LineSeries());
            series3.dataFields.valueY = "batas_atas";
            series3.dataFields.dateX = "date";
            series3.name = "Ambang Batas Atas";
            series3.yAxis = valueAxis1;
            series3.stroke = am4core.color("#ff0000");
            
            /*var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
            bullet3.circle.radius = 3;
            bullet3.circle.strokeWidth = 2;
            bullet3.circle.fill = am4core.color("#fff");*/
            
            // Add cursor
            chart.cursor = new am4charts.XYCursor();
            
            // Add legend
            chart.legend = new am4charts.Legend();
            chart.legend.position = "top";
            
            // Add scrollbar
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series1);
            chart.scrollbarX.series.push(series2);
            chart.scrollbarX.series.push(series3);
            chart.scrollbarX.parent = chart.bottomAxesContainer;
            // Enable export
            chart.exporting.menu = new am4core.ExportMenu();
        });	
        var dataNat = [];
        $.ajax({
            url: "{{ url('/report/chartNat') }}?id_span="+id_span+'&from_date='+from_date+'&to_date='+to_date,
            dataType: "json",
            async: false,
            type: "GET",
            success: function(data) {
                $.each(data, function(index, item) {
                    var newDates = item.date;
                    dataNat.push({
                        date: new Date(newDates),
                        value: item.value,
                    })
                });
            }
        });

        var lokasi = document.getElementById("id_lokasi");
        var nama_lokasi = lokasi.options[lokasi.selectedIndex].text;
        var span = document.getElementById("id_span");
        var nama_span = span.options[span.selectedIndex].text;
        var sensor = document.getElementById("id_sensor");
        var nama_sensor = sensor.options[sensor.selectedIndex].text;
        $("#resultfilter").html('Data '+nama_lokasi+' - '+nama_span+' - '+nama_sensor+' tanggal '+from_date+' - '+to_date+'');
        $("#downloadBtn").html('<a href="{{ URL::to("report/downloadExcel") }}?id_sensor='+id_sensor+'&from_date='+from_date+'&to_date='+to_date+'"" class="btn btn-sm btn-primary">Download Data</a>');

        var chartContainer = am4core.create("nat-freq", am4charts.XYChart);

        console.log(dataNat)
        // Set the chart's data
        chartContainer.data = dataNat;

        // Create the date axis
        var dateAxis = chartContainer.xAxes.push(new am4charts.DateAxis());
        dateAxis.dataFields.category = "date";
        dateAxis.renderer.grid.template.location = 0;
        dateAxis.groupData = true;
        dateAxis.groupIntervals.setAll([
            {
                timeUnit: "hour",
                count: 1
            },
            {
                timeUnit: "hour",
                count: 20
            },
        ]);

        // Create the value axis
        var valueAxis = chartContainer.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 35;

        // Create the line series
        var lineSeries = chartContainer.series.push(new am4charts.LineSeries());
        lineSeries.dataFields.dateX = "date";
        lineSeries.dataFields.valueY = "value";
        lineSeries.strokeWidth = 2;
        lineSeries.tensionX = 0.7;
        lineSeries.minBulletDistance = 15;

        // Configure the scrollbar
        chartContainer.scrollbarX = new am4charts.XYChartScrollbar();
        chartContainer.scrollbarX.series.push(lineSeries);
        chartContainer.scrollbarX.parent = chartContainer.bottomAxesContainer;

        // Add a cursor to the chart
        chartContainer.cursor = new am4charts.XYCursor();
        chartContainer.cursor.behavior = "panX";
        chartContainer.cursor.xAxis = dateAxis;
        chartContainer.exporting.menu = new am4core.ExportMenu();

	}
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {               
            e.preventDefault();
            return false;
        }
    });
    
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });

    const sensorMapping = {
        "Tiltmeter_01": "Tiltmeter 1",
        "Tiltmeter_02": "Tiltmeter 2",
        "Accl_AA222_01_E": "Accelerometer 1_Y",
        "Accl_AA222_01_N": "Accelerometer 1_X",
        "Accl_AA222_01_U": "Accelerometer 1_Z",
        "Accl_AA222_02_E": "Accelerometer 2_Y",
        "Accl_AA222_02_N": "Accelerometer 2_X",
        "Accl_AA222_02_U": "Accelerometer 2_Z",
        "Disp_AA222_01_N": "Displacement 1_X",
        "Disp_AA222_01_E": "Displacement 1_Y",
        "Disp_AA222_01_U": "Displacement 1_Z",
        "Disp_AA222_02_N": "Displacement 2_X",
        "Disp_AA222_02_E": "Displacement 2_Y",
        "Disp_AA222_02_U": "Displacement 2_Z",
        "Full_Bridge_01": "Strain Gauge 1",
        "Full_Bridge_02": "Strain Gauge 2"
    };

    $("#id_vendor").change(function(){
        var id_vendor = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ url('/listLokasi/') }}/" + id_vendor,
            cache: false,
            success: function(data) {
                if (data) {
                    $('#id_lokasi').empty().append('<option hidden>-- Pilih Lokasi --</option>');
                    $('#id_span').empty().append('<option hidden>-- Pilih Span --</option>');
                    $('#id_sensor').empty().append('<option hidden>-- Pilih Sensor --</option>');
                    $.each(data.items, function(index, item) {
                        $("#id_lokasi").append('<option value="' + item.slug + '">' + item.nama_lokasi + '</option>');
                    });
                } else {
                    $('#id_lokasi, #id_span, #id_sensor').empty();
                }
            }
        });
    });

    $("#id_lokasi").change(function(){
        var id_lokasi = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ url('/listSpanLokasi/') }}/" + id_lokasi,
            cache: false,
            success: function(data) {
                if (data) {
                    $('#id_span').empty().append('<option hidden>-- Pilih Span --</option>');
                    $('#id_sensor').empty().append('<option hidden>-- Pilih Sensor --</option>');
                    $.each(data.items, function(index, item) {
                        $("#id_span").append('<option value="' + item.id + '">' + item.nama_span + '</option>');
                    });
                } else {
                    $('#id_span, #id_sensor').empty();
                }
            }
        });
    });

    $("#id_span").change(function(){
        var id_span = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ url('/listSensor/') }}/" + id_span,
            cache: false,
            success: function(data) {
                if (data) {
                    $('#id_sensor').empty().append('<option hidden>-- Pilih Sensor --</option>');
                    $.each(data.items, function(index, item) {
                        let sensorName = sensorMapping[item.sensor_id] || item.sensor_id; // Gunakan nama custom jika tersedia
                        $("#id_sensor").append('<option value="' + item.id + '">' + sensorName + '</option>');
                    });
                } else {
                    $('#id_sensor').empty();
                }
            }
        });
    });
</script>
@endsection