@extends('layouts.admin')
@section('title', 'Vendor')
@section('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.2.0"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/3.0.1/chartjs-plugin-annotation.min.js"></script> --}}

    <style>
        .filter-list {
            display: flex;
            margin-bottom: 10px;
        }

        .btn-filter {
            background: #aeaebd;
            border-radius: 0;
            border: none;
            color: white;
        }

        .form-group {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')

    <div class="col-12">
        <div class="row">
            <div class="col-7">
                <h4 class="black-color"><a style="color:black!important;" href="../">{{ $vendor->nama_vendor }}</a> - <a
                        style="color:black!important;" href="./">{{ $lokasi->nama_lokasi }} </a> - {{ $span->nama_span }}
                </h4>
            </div>
            <div class="col-5" style="text-align:right;">
                <button type="button" data-action="add" style="float:right;margin-bottom: 10px;"
                    class="action btn btn-primary">Tambah Sensor</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row" style="height:100%;">
                    <div class="col-3" style="padding:0;">
                        <div class="form-group">
                            <select id="sensor_id" class="form-control select2" name="sensor_id"
                                data-placeholder="sensor_id" required="required" onchange="updateChart()">
                            </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <div id="status-sensor" class="form-control box-value"
                                style="background: black;text-align:center;padding: 3px 15px;margin-top: 4px;">
                                <div style="margin: auto;color: white;font-weight: bold;" id="current-value">Current Value :
                                    0</div>
                            </div>
                        </div>
                    </div>
                    <div class="chart" style="border-radius: 0px 0px 20px 20px;">
                        <canvas id="myChart" style=" width: 100%;height: 300px;"></canvas>
                    </div>
                    <div class="chart" style="border-radius: 0px 0px 20px 20px; margin-top: 20px;">
                        <div class="chart-header"
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <div>
                                <label for="datePicker" style="font-weight: bold; margin-right: 10px;">Select Date:</label>
                                <input type="date" id="datePicker" onchange="updateNatFreqChartByDate()"
                                    style="padding: 5px; border: 1px solid #ccc; border-radius: 5px;" />
                            </div>
                            <div class="legend-container" style="display: flex; gap: 15px; align-items: center;">
                                <div style="display: flex; align-items: center; margin-left: -10px;">
                                    <div style="width: 20px; height: 5px; background: rgb(255, 0, 0); margin-right: 5px;">
                                    </div>
                                    <span>Failure</span>
                                </div>
                                <div style="display: flex; align-items: center; margin-left: -10px;">
                                    <div style="width: 20px; height: 5px; background: rgb(255, 165, 0); margin-right: 5px;">
                                    </div>
                                    <span>Critical</span>
                                </div>
                            </div>
                        </div>
                        <canvas id="natFreqChart" style="width: 100%; height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
    <form id="form-field" autocomplete="off">
        <div class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sensor</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id_sensor" value="" required>
                        <input type="hidden" name="id_span" id="id_span" value="{{ $span->id }}" required>

                        <div class="form-group">
                            <label><b>Sensor</b></label>
                            <select id="id_sensor" class="form-control select2" name="id_sensor"
                                data-placeholder="id_sensor" required="required">
                                <option value="">-- Pilih Sensor --</option>
                                @foreach ($sensor as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_parameter }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Sensor ID</b></label>
                            <input type="text" class="form-control" value="" placeholder="Masukkan Sensor ID"
                                name="nama_sensor" id="nama_sensor">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                        <button type="button" data-action="simpan"
                            class="action btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        function showData() {
            var pathArray = window.location.href.split('/');
            var idVendor = pathArray[4];
            var id = pathArray[7];
            $.ajax({
                type: "get",
                url: "{{ url('/listSensor') }}/" + id,
                cache: false,
                success: function(data) {
                    $.each(data.items, function(index, item) {
                        $('#sensor_id').empty();
                        $.each(data.items, function(index, item) {
                            $("#sensor_id").append('<option value="' + item.id + '">' + item
                                .sensor_id + '</option>');
                        });
                    });
                }
            });
            selectTags = document.querySelectorAll('select');

            for (var i = 0; i < selectTags.length; i++) {
                selectTags[i].selectedIndex = 0;
            }
        }
        showData();

        let chart;

        function createChart() {
            const ctx = document.getElementById('myChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Sensor',
                        data: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.2,
                    }, ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Acceleration'
                            }
                        },
                        x: {
                            type: 'category',
                            title: {
                                display: true,
                                text: 'Time (s)',
                            },
                        },
                    }
                }

            });
        }

        createChart();

        async function updateChart() {
            const selectedSensor = document.getElementById('sensor_id');
            const selectedOption = selectedSensor.value;
            const sensorType = selectedSensor.options[selectedSensor.selectedIndex]?.text
        .toLowerCase(); 

            try {
                const response = await fetch("{{ url('/live_sensor/chartList') }}?id_sensor=" + selectedOption);
                const data = await response.json();

                let yAxisLabel = "Acceleration "; // Default
                if (sensorType.includes("displacement")) {
                    yAxisLabel = "Displacement";
                } else if (sensorType.includes("tiltmeter")) {
                    yAxisLabel = "Degree";
                } else if (sensorType.includes("strain gauge")) {
                    yAxisLabel = "Microstrain";
                }

                chart.options.scales.y.title.text = yAxisLabel;

                chart.data.labels.push(data.datetime);
                chart.data.datasets[0].data.push(data.value);

                if (chart.data.labels.length > 10) {
                    chart.data.labels.shift();
                    chart.data.datasets[0].data.shift();
                }

                document.getElementById('status-sensor').style.backgroundColor = data.status;
                $("#current-value").html(`Current Value = ${data.value} ${data.satuan}`);

                chart.update();
            } catch (error) {
                console.error("Error fetching sensor data:", error);
            }
        }

        setInterval(updateChart, 3000);
    </script>

    <script>
        let natFreqChart;

        function createNatFreqChart() {
            const ctx = document.getElementById('natFreqChart').getContext('2d');
            natFreqChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                            label: 'X',
                            data: [],
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderWidth: 2,
                            tension: 0.2,
                        },
                        {
                            label: 'Y',
                            data: [],
                            borderColor: 'rgba(50, 205, 50, 1)',
                            backgroundColor: 'rgba(50, 205, 50, 0.5)',
                            borderWidth: 2,
                            tension: 0.2,
                        },
                        {
                            label: 'Z',
                            data: [],
                            borderColor: 'rgba(75, 0, 130, 1)',
                            backgroundColor: 'rgba(75, 0, 130, 0.5)',
                            borderWidth: 2,
                            tension: 0.2,
                        }
                    ],
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            title: {
                                display: true,
                                text: 'Time (h)',
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Frequency (Hz)',
                            },
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        annotation: {
                            annotations: {
                                critical: {
                                    type: 'line',
                                    yMin: 1.10,
                                    yMax: 1.10,
                                    borderColor: 'orange',
                                    borderWidth: 2,
                                },
                                failure: {
                                    type: 'line',
                                    yMin: 0.98,
                                    yMax: 0.98,
                                    borderColor: 'red',
                                    borderWidth: 2,
                                }
                            }
                        }
                    }
                },
            });
        }

        createNatFreqChart();

        async function updateNatFreqChart(date) {
            const selectedSensor = document.getElementById('sensor_id').options[document.getElementById('sensor_id')
                .selectedIndex].text;
            const natFreqChartDiv = document.getElementById('natFreqChart').parentElement;

            if (!selectedSensor.startsWith("Accelerometer 1")) {
                natFreqChartDiv.style.display = "none";
                return;
            }
            natFreqChartDiv.style.display = "block";

            const stationId = "GSI_ASTRA";
            try {
                const response = await fetch(
                    `{{ url('/live_sensor/natFreqChartList') }}?station_id=${stationId}&date=${date}`);
                const data = await response.json();

                const uniqueTimes = {};
                const formattedTimes = data.time.map(time => {
                    const dateObj = new Date(time);
                    return dateObj.toLocaleTimeString('en-GB', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                });

                formattedTimes.forEach((time, index) => {
                    if (!uniqueTimes[time]) {
                        uniqueTimes[time] = {
                            x: null,
                            y: null,
                            z: null
                        };
                    }
                    if (uniqueTimes[time].x === null) {
                        uniqueTimes[time].x = data.x[index] ?? 0;
                    } else if (uniqueTimes[time].y === null) {
                        uniqueTimes[time].y = data.y[index] ?? 0;
                    } else if (uniqueTimes[time].z === null) {
                        uniqueTimes[time].z = data.z[index] ?? 0;
                    }
                });

                const times = Object.keys(uniqueTimes);
                natFreqChart.data.labels = times;

                natFreqChart.data.datasets[0].data = times.map(time => ({
                    x: time,
                    y: uniqueTimes[time].x
                }));
                natFreqChart.data.datasets[1].data = times.map(time => ({
                    x: time,
                    y: uniqueTimes[time].y
                }));
                natFreqChart.data.datasets[2].data = times.map(time => ({
                    x: time,
                    y: uniqueTimes[time].z
                }));

                natFreqChart.update();
            } catch (error) {
                console.error("Failed to fetch data:", error);
            }
        }

        function updateNatFreqChartByDate() {
            const datePicker = document.getElementById('datePicker');
            const selectedDate = datePicker.value;
            if (selectedDate) {
                updateNatFreqChart(selectedDate);
            }
        }

        setInterval(() => {
            const datePicker = document.getElementById('datePicker');
            const selectedDate = datePicker.value || new Date().toISOString().split('T')[0];
            updateNatFreqChart(selectedDate);
        }, 3000);
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
        var mode;

        function show_modal(data) {

            if (mode == "add") {
                $('#form-field').children('.modal').find('.modal-title').text("Tambah Sensor");
                $('#form-field').find('select[name="id_sensor"]').val("");
                $('#form-field').find('input[name="nama_sensor"]').val("");
                $('#form-field').find('input[name="id"]').val("");
                $('#form-field').children('.modal').modal('show');
            } else if (mode == "edit") {
                $.ajax({
                    url: "{{ url('/user') }}/" + data + "/edit",
                    dataType: "json",
                    type: "GET",
                    success: function(data) {
                        $('#form-field').find('select[name="id_vendor"]').val(data.id_vendor);
                        $('#form-field').find('input[name="name"]').val(data.name);
                        $('#form-field').find('input[name="email"]').val(data.email);
                        $('#form-field').find('select[name="role"]').val(data.role);
                        $('#form-field').find('input[name="id"]').val(data.id);

                    }
                })
                $('#form-field').children('.modal').find('.modal-title').text("Edit User");
                $('#form-field').children('.modal').modal('show');

            } else if (mode == "hapus") {
                $('#form-field-hapus').children('.modal').find('.modal-title').text("Hapus User");
                $('#form-field-hapus').find('input[name="id_user"]').val(data);
                $('#form-field-hapus').children('.modal').modal('show');
            }
        }

        function reset_default() {
            $('#form-field')[0].reset();
            $('#form-field').find('input[name="id"]').val('');
            mode = undefined;
            $('#form-field').children('.modal').modal('hide');
            $('#sensor-filter').html('');
            showData();
        }

        function reset_default_hapus() {
            $('#form-field-hapus')[0].reset();
            $('#form-field-hapus').find('input[name="id_user"]').val('');
            mode = undefined;
            table1.ajax.reload(null, false);
            $('#form-field-hapus').children('.modal').modal('hide');
        }

        function clear() {
            $('#form-field')[0].reset();
        }

        function clear_hapus() {
            $('#form-field-hapus')[0].reset();
        }

        $(document).on('click', ".action", function() {
            $('.closemodal').click(function() {
                $('#form-field').children('.modal').modal('hide');
                $('#form-field-hapus').children('.modal').modal('hide');
            });
            var self = this;

            var action = $(this).attr('data-action');
            if (action == "delete") {
                var data = $(this).attr('data-id');
                var nama = $(this).closest("tr").find("td:eq(1)").text();
                var id = $("input[name='id_user']").val();

                $.ajax({
                    url: "{{ url('/user') }}/" + id,
                    dataType: "json",
                    data: {
                        _token: '{!! csrf_token() !!}'
                    },
                    type: "DELETE",
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            swal({
                                title: "Success!",
                                text: "User " + nama + ' Berhasil Dihapus',
                                type: "success",
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: data.error,
                                type: "error",
                            });
                        }
                        reset_default_hapus();
                    }
                })
            } else if (action == "add") {
                mode = "add";
                clear();
                show_modal();
            } else if (action == "edit") {
                mode = "edit";
                var data = $(this).attr('data-id');
                show_modal(data);
            } else if (action == "hapus") {
                mode = "hapus";
                var data = $(this).attr('data-id');
                show_modal(data);
            } else if (action == "simpan") {
                var ids = "";

                var id = $("input[id='id_sensor']").val();
                if (id == "") {
                    var tipe = "POST";
                } else {
                    var tipe = "PUT";
                    var ids = "/" + id;
                }

                $.ajax({
                    url: "{{ url('/insertSensor') }}" + ids,
                    dataType: "json",
                    data: $('#form-field').serialize() + "&_token={!! csrf_token() !!}",
                    type: tipe,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            swal({
                                title: "Success!",
                                text: data.success,
                                type: "success",
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: data.error,
                                type: "error",
                            });
                        }
                        reset_default();
                    }
                })
            }
        })
        $('form').bind("keypress", function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>

    <script>
        const customSensorNames = {
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

        function getCustomSensorName(sensorName) {
            return customSensorNames[sensorName] || sensorName || "Unknown Sensor";
        }

        function showData() {
            var pathArray = window.location.href.split('/');
            var idVendor = pathArray[4];
            var id = pathArray[7];

            $.ajax({
                type: "get",
                url: "{{ url('/listSensor') }}/" + id,
                cache: false,
                success: function(data) {
                    $('#sensor_id').empty();

                    $.each(data.items, function(index, item) {
                        let customName = getCustomSensorName(item.sensor_id);
                        $("#sensor_id").append(
                            `<option value="${item.id}" data-sensor="${item.sensor_id}">${customName}</option>`
                        );
                    });

                    if (data.items.length > 0) {
                        $("#sensor_id").val(data.items[0].id).trigger('change');
                    }
                }
            });

            selectTags = document.querySelectorAll('select');
            for (var i = 0; i < selectTags.length; i++) {
                selectTags[i].selectedIndex = 0;
            }
        }

        showData();
    </script>
@endsection