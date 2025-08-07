@extends('layouts.admin')
@section('title', 'Client')
@section('style')
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
                                <h4 class="black-color">Daftar Client</h4>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <button type="button" data-action="add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah Client</button>
                            </div>
                        </div>
                        <div class="row" id="list-vendor">
                            
                        </div>
                    </div>
                </div>
<!-- / Content -->
<form id="form-field" enctype="multipart/form-data" autocomplete="off" >
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Client</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_vendor" value="" required>
                    <div class="form-group">
                        <label><b>Nama Client</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama Client" name="nama_vendor" id="nama_vendor">
                    </div>
                    <div class="form-group">
                        <label><b>Foto Client</b></label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                    <!--<button type="button" data-action="simpan" class="action btn btn-primary waves-effect waves-light">Simpan</button>-->
                    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>
<form id="form-field-edit" enctype="multipart/form-data" autocomplete="off" >
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Client</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_vendors" id="id_vendors" value="" required>
                    <div class="form-group">
                        <label><b>Nama Client</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama Client" name="nama_vendors" id="nama_vendors">
                    </div>
                    <div class="form-group">
                        <label><b>Foto Client</b></label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                    <input type="submit" name="uploads" id="uploads" class="btn btn-primary" value="Simpan">
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
                    <input type="hidden" name="id_vendor" id="konfirmasiId" value="">
                    <h4 align="center">Anda yakin akan menghapus Client ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-action="delete" class="action btn btn-primary waves-effect waves-light">Delete</button>
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form> 
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    
    function showData(){
        $.ajax({
            url: "{{ url('/vendor/listVendor') }}",
            dataType: "json",
            async: true,
            type: "GET",
            success: function(data) {		
                $.each(data.items, function(index, item) {
                    $('#list-vendor').append('<div class="col-4"><div class="loc-list"> <a href="{{ url("/vendor")}}/'+item.slug+'/"><img src="{{ url("/assets") }}/img/vendor/'+item.image+'"></a><div class="btn-group" style="position: absolute;"><button style="background: #545c58ab;border: none;position: absolute;top: -16px;right: -16px;" type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" style="padding: 2px 4px;"><button type="button" data-id="'+item.id+'" data-action="edit" class="action btn btn-sm" data-toggle="tooltip" title="Ubah"><i class="bx bxs-edit"></i>&nbsp; Ubah</button></a><li><a class="dropdown-item" style="padding: 2px 4px;"><button type="button" data-id="'+item.id+'" data-action="hapus" class="action btn btn-sm" data-toggle="tooltip" title="Delete"><i class="bx bxs-trash"></i>&nbsp; Hapus</button></a></li></ul></div><center><h4 class="black-color mb-0 mt-3"><b>'+item.nama_vendor+'</b></h4></center></div></div>');
                });	
            }
        });
    }
    showData();
    
    var mode;

    function show_modal(data) {

        if (mode == "add") {
            $('#form-field').children('.modal').find('.modal-title').text("Tambah Client");
			$('#form-field').find('input[name="nama_vendor"]').val("");
			$('#form-field').find('input[name="image"]').val("");
            $('#form-field').find('input[name="id"]').val("");
            $('#form-field').children('.modal').modal('show');
        } else if (mode == "edit") {
            $.ajax({
                url: "{{ url('/editVendor') }}/" + data,
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $('#form-field-edit').find('input[name="nama_vendors"]').val(data.nama_vendor);
                    $('#form-field-edit').find('input[name="id_vendors"]').val(data.id);
                }
            })
            $('#form-field-edit').children('.modal').find('.modal-title').text("Edit Client");
            $('#form-field-edit').children('.modal').modal('show');
           
        } else if (mode == "hapus"){
            $('#form-field-hapus').children('.modal').find('.modal-title').text("Hapus Client");
            $('#form-field-hapus').find('input[name="id_vendor"]').val(data);
            $('#form-field-hapus').children('.modal').modal('show');
        }
    }

    function reset_default() {
        $('#form-field')[0].reset();
        $('#form-field').find('input[name="id"]').val('');
        mode = undefined;
        $('#list-vendor').html('');
        $('#form-field').children('.modal').modal('hide');
        showData();
    }
    function reset_defaults() {
        $('#form-field-edit')[0].reset();
        $('#form-field-edit').find('input[name="id_vendors"]').val('');
        mode = undefined;
        $('#list-vendor').html('');
        $('#form-field-edit').children('.modal').modal('hide');
        showData();
    }

    function reset_default_hapus() {
        $('#form-field-hapus')[0].reset();
        $('#form-field-hapus').find('input[name="id_vendor"]').val('');
        mode = undefined;
        $('#list-vendor').html('');
        $('#form-field-hapus').children('.modal').modal('hide');
        showData();
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
            $('#form-field-edit').children('.modal').modal('hide');
            $('#form-field-hapus').children('.modal').modal('hide');
        });
        var self = this;

        var action = $(this).attr('data-action');
		if (action == "delete") {
            var data = $(this).attr('data-id');
            var id = $("input[name='id_vendor']").val();

            $.ajax({
                url: "{{ url('/vendor') }}/" + id,
                dataType: "json",
                data: {
                    _token: '{!! csrf_token() !!}'
                },
                type: "DELETE",
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
        }
    })
    $(document).ready(function(){

        $('#form-field').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ url('/vendor') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
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
        });
        $('#form-field-edit').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ url('/updateVendor') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
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
                    reset_defaults();
                }
            })
        });

    });
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {               
            e.preventDefault();
            return false;
        }
    });

</script>
@endsection