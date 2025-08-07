@extends('layouts.admin')
@section('title', 'Daftar Account Client')
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
                                <h5 class="black-color">Daftar Account Client</h5>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <button type="button" data-action="add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah Account Client</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card" style="padding:10px">
                                    <div class="table-body">
                                        <div class="table-responsive" style="overflow-x: hidden;">
                                            <table id="table-user" class="table table-bordered" style="font-size: 11px;">
                                                <thead style="background: #0ec8cf;color: white;">
                                                    <tr class=" text-center">
                                                        <th style="color: white;">No</th>
                                                        <th style="color: white;">Client</th>
                                                        <th style="color: white;">Nama</th>
                                                        <th style="color: white;">Email</th>
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
                    <h5 class="modal-title">Tambah Account Client</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_user" value="" required>
                    <div class="form-group">
                        <label><b>Pilih Client</b></label>
                        <select id="id_vendor" class="form-control select2" name="id_vendor" data-placeholder="id_vendor" required="required">
							<option value="">-- Silahkan Pilih Client --</option>
                            @foreach($vendor as $data)
                            <option value="{{$data->id}}">{{$data->nama_vendor}}</option>
                            @endforeach
						</select>
                    </div>
                    <div class="form-group">
                        <label><b>Nama</b></label>
                        <input type="text" class="form-control" value="" placeholder="Nama" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="text" class="form-control" value="" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="form-group" id="updateuser">
                        <label><b>Password</b></label>
                        <input type="text" class="form-control" value="" placeholder="Password" name="password" id="password">
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="konfirmasiId" value="">
                    <h4 align="center">Anda yakin akan menghapus Account Client ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-action="delete" class="action btn btn-primary waves-effect waves-light">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
        table1 = $('#table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/user/list-user') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'vendor', name: 'vendor'},
                {data: 'nama', name: 'nama'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action'},
            ]
        });
    });

   var mode;

    function show_modal(data) {

        if (mode == "add") {
            $('#form-field').children('.modal').find('.modal-title').text("Tambah Account Client");
            $('#form-field').find('select[name="id_vendor"]').val("");
			$('#form-field').find('input[name="name"]').val("");
			$('#form-field').find('input[name="email"]').val("");
            $('#form-field').find('input[name="id"]').val("");
            document.getElementById("updateuser").style.display = "none";
            $('#form-field').children('.modal').modal('show');
        } else if (mode == "edit") {
            
            $.ajax({
                url: "{{ url('/user') }}/" + data + "/edit",
                dataType: "json",
                type: "GET",
                success: function(data) {
                    document.getElementById("updateuser").style.display = "inline";
					$('#form-field').find('select[name="id_vendor"]').val(data.id_vendor);
                    $('#form-field').find('input[name="name"]').val(data.name);
                    $('#form-field').find('input[name="email"]').val(data.email);
                    $('#form-field').find('input[name="password"]').val("");
                    $('#form-field').find('input[name="id"]').val(data.id);
                    
                }
            })
            $('#form-field').children('.modal').find('.modal-title').text("Edit Account Client");
            $('#form-field').children('.modal').modal('show');
           
        } else if (mode == "hapus"){
            $('#form-field-hapus').children('.modal').find('.modal-title').text("Hapus Account Client");
            $('#form-field-hapus').find('input[name="id_user"]').val(data);
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
            
            var id = $("input[id='id_user']").val();
            if (id == "") {
                var tipe = "POST";
            } else {
                var tipe = "PUT";
                var ids = "/"+id;
            }

            $.ajax({
                url: "{{ url('/user') }}" + ids,
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