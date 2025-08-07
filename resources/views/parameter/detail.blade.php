@extends('layouts.admin')
@section('title', 'Daftar Sensor')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ url('/assets') }}/css/dataTables.bootstrap4.min.css">
 <style>
.form-group{
    margin-bottom: 10px;
}
</style>

@endsection
@section('content')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="black-color">Daftar Sensor Client</h5>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <!--<button type="button" data-action="add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah User</button>-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card" style="padding:10px">
                                    <div class="table-body">
                                        <div class="table-responsive" style="overflow-x: hidden;">
                                            <table id="table-parameter" class="table table-bordered" style="font-size: 11px;">
                                                <thead style="background: #0ec8cf;color: white;">
                                                    <tr class=" text-center">
                                                        <th style="color: white;">No</th>
                                                        <th style="color: white;">Nama Client</th>
                                                        <th style="color: white;">Lokasi</th>
                                                        <th style="color: white;">Span</th>
                                                        <th style="color: white;">Sensor</th>
                                                        <th style="color: white;">Sensor ID</th>
                                                        <th style="color: white;">Batas Bawah</th>
                                                        <th style="color: white;">Batas Atas</th>
                                                        <th style="color: white;">Satuan</th>
                                                        <th style="color: white;">Aksi</th>
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
<form id="form-field" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sensor</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_sensor" value="" required>
                    <div class="form-group">
                        <label><b>Nama Client</b></label>
                        <input type="text" class="form-control" value="" placeholder="Nama Client" name="nama_client" id="nama_client" disabled>
                    </div>
                    <div class="form-group">
                        <label><b>Nama Sensor</b></label>
                        <input type="text" class="form-control" value="" placeholder="Nama Sensor" name="nama_parameter" id="nama_parameter" disabled>
                    </div>
                    <div class="form-group">
                        <label><b>Sensor ID</b></label>
                        <input type="text" class="form-control" value="" placeholder="Sensor ID" name="sensorId" id="sensorId">
                    </div>
                    <div class="form-group">
                        <label><b>Lokasi</b></label>
                        <input type="text" class="form-control" value="" placeholder="Lokasi" name="lokasi" id="lokasi" disabled>
                    </div>
                    <div class="form-group">
                        <label><b>Span</b></label>
                        <input type="text" class="form-control" value="" placeholder="Span" name="span" id="span" disabled>
                    </div>
                    
                    <div class="form-group">
                        <label><b>Batas Bawah</b></label>
                        <input type="text" class="form-control" value="" placeholder="Batas Bawah" name="batas_bawah" id="batas_bawah">
                    </div>
                    <div class="form-group">
                        <label><b>Batas Atas</b></label>
                        <input type="text" class="form-control" value="" placeholder="Batas Atas" name="batas_atas" id="batas_atas">
                    </div>
                    <div class="form-group">
                        <label><b>Satuan</b></label>
                        <input type="text" class="form-control" value="" placeholder="Satuan" name="satuan" id="satuan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                    <button type="button" data-action="simpan" class="action btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form id="form-field-hapus">
    <div class="modal fade" id="modal_hapus" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_sensor" id="konfirmasiId" value="">
                    <h4 align="center">Anda yakin akan menghapus Sensor Client ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-action="delete" class="action btn btn-primary waves-effect waves-light">Delete</button>
                    <button type="button" class="btn btn-default closemodal" data-dismiss="modal">Batal</button>
                </div>


            </div>
        </div>
    </div>
</form> 
@endsection
@section('script')
<script src="{{ url('/assets') }}/js/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/assets') }}/js/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    
    var table1;
    $(function() {
        table1 = $('#table-parameter').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/client_sensor/listParameterClient') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama_client', name: 'nama_client'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'span', name: 'span'},
                {data: 'nama_parameter', name: 'nama_parameter'},
                {data: 'sensorId', name: 'sensorId'},
                {data: 'batas_bawah', name: 'batas_bawah'},
                {data: 'batas_atas', name: 'batas_atas'},
                {data: 'satuan', name: 'satuan'},
                {data: 'action', name: 'action'},
            ]
        });
    });

   var mode;

    function show_modal(data) {

        if (mode == "edit") {
            $.ajax({
                url: "{{ url('/client_sensor') }}/" + data + "/edit",
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $('#form-field').find('input[name="nama_client"]').val(data.nama_client);
                    $('#form-field').find('input[name="nama_parameter"]').val(data.nama_sensor);
                    $('#form-field').find('input[name="sensorId"]').val(data.sensorId);
                    $('#form-field').find('input[name="lokasi"]').val(data.lokasi);
                    $('#form-field').find('input[name="span"]').val(data.span);
                    $('#form-field').find('input[name="batas_bawah"]').val(data.batas_bawah);
                    $('#form-field').find('input[name="batas_atas"]').val(data.batas_atas);
                    $('#form-field').find('input[name="satuan"]').val(data.satuan);
                    $('#form-field').find('input[name="id"]').val(data.id);
                }
            })
            $('#form-field').children('.modal').find('.modal-title').text("Edit Sensor");
            $('#form-field').children('.modal').modal('show');
           
        }else if (mode == "hapus"){
            $('#form-field-hapus').children('.modal').find('.modal-title').text("Hapus Sensor Client");
            $('#form-field-hapus').find('input[name="id_sensor"]').val(data);
            $('#form-field-hapus').children('.modal').modal('show');
        }
    }

    function reset_default() {
        $('#form-field')[0].reset();
        $('#form-field').find('input[name="id"]').val('');
        mode = undefined;
        table1.ajax.reload(null, false);
        $('#form-field').children('.modal').modal('hide');
    }
	function reset_default_hapus() {
        $('#form-field-hapus')[0].reset();
        $('#form-field-hapus').find('input[name="id_sensor"]').val('');
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
            var id = $("input[name='id_sensor']").val();

            $.ajax({
                url: "{{ url('/client_sensor') }}/" + id,
                dataType: "json",
                data: {
                    _token: '{!! csrf_token() !!}'
                },
                type: "DELETE",
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        swal({
                            title: "Success!",
                            text: "Sensor " + nama + ' Berhasil Dihapus',
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
                var ids = "/"+id;
            }

            $.ajax({
                url: "{{ url('/client_sensor') }}" + ids,
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
@endsection