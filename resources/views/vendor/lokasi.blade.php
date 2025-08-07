@extends('layouts.admin')
@section('title', 'Vendor')
@section('style')
<style>
.form-group{
    margin-bottom: 10px;
}
.spanDrag {
    position: absolute;
    cursor: move;
    padding: 10px;
    background-size:cover;
    background-repeat: no-repeat;
    width: 75px;
    height: 120px;
}
</style>

@endsection
@section('content')

                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="black-color"><a style="color:black!important;" href="./">{{$vendor->nama_vendor}}</a> - {{$lokasi->nama_lokasi}}</h4>
                        </div>
                        <div class="col-6" style="text-align:right;">
                        <button type="button" data-action="add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah Span</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="height:100%;">
                                <div class="home-jembatan" style="background-image: url('{{ url('/assets') }}/img/lokasi/{{$lokasi->foto}}');">
                                    <div class="row" style="height:100%;" id="list-span">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top:10px;">
                            <div class="d-flex">
                                <div class="d-flex align-item-center mx-3 my-2">
                                    <span class="status-circle status-critical"></span>
                                    <div class="status-info">Critical</div>
                                </div>
                                <div class="d-flex align-item-center mx-3  my-2">
                                    <span class="status-circle status-warning"></span>
                                    <div class="status-info">Warning</div>
                                </div>
                                <div class="d-flex align-item-center mx-3  my-2">
                                    <span class="status-circle status-good"></span>
                                    <div class="status-info">Good</div>
                                </div>
                                <div class="d-flex align-item-center mx-3  my-2">
                                    <span class="status-circle status-off"></span>
                                    <div class="status-info">Offline</div>
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
                    <h5 class="modal-title">Tambah Span</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_span" value="" required>
                    <input type="hidden" name="id_lokasi" id="id_lokasi" value="{{$lokasi->id}}" required>
                    <div class="form-group">
                        <label><b>Nama Span</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama Span" name="nama_span" id="nama_span">
                    </div>
                    <div class="form-group">
                        <label><b>Station ID</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Station ID" name="station_id" id="station_id">
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
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    /*$(document).ready(function() {
        realtime();
    });

    function realtime() {
        setTimeout(function() {
            showData();
            realtime();
        }, 1000);
    }*/

    function showData(){
        var pathArray = window.location.href.split('/');
        var idVendor = pathArray[4];
        var id = pathArray[5];

        $.ajax({
            url: "{{ url('/listSpan') }}/"+id,
            dataType: "json",
            async: false,
            type: "GET",
            success: function(data) {
            console.log(data);

                $('#list-span').html('');
                $.each(data.items, function(index, item) {
                    $('#list-span').append('<div class="col-lg"><a href="{{ url("/vendor")}}/'+idVendor+'/'+id+'/live_sensor"><div class="loc-sensor"><div class="list-sensor spanDrag" id="span_'+item.id+'" style="inset:'+item.y+'px auto auto '+item.x+'px;""><img src="{{ url("/assets") }}/img/'+item.status+'.png"><h5>'+item.no+'</h5></div></div></a></div>');
                });
            }
        });
        $(document).ready(function() {
            $(".spanDrag").draggable({
                stop: function(event, ui) {
                var id = $(this).attr("id");
                var top = ui.position.top;
                var left = ui.position.left;
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('/updatePositionSpan') }}",
                    type: 'POST',
                    data: { id: id, top: top, left: left, _token:token},
                    success: function(response) {
                    console.log('Position saved:', response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown);
                    }
                });
                }
            });
        });
    }
    showData();
    $(document).ready(function() {
        realtime();
    });

    function realtime() {
        setTimeout(function() {
            statusUpdate();
            realtime();
        }, 15000);
    }

    function statusUpdate(){
        var pathArray = window.location.href.split('/');
        var idVendor = pathArray[4];
        var id = pathArray[5];

        $.ajax({
            url: "{{ url('/listSpan') }}/"+id,
            dataType: "json",
            async: true,
            type: "GET",
            success: function(data) {
                $.each(data.items, function(index, item) {
                    $("#span_"+item.id).html('<img src="{{ url("/assets") }}/img/'+item.status+'.png"><h5>'+item.no+'</h5>');
                });
            }
        });
    }
    var mode;

    function show_modal(data) {

        if (mode == "add") {
            $('#form-field').children('.modal').find('.modal-title').text("Tambah Span");
			$('#form-field').find('input[name="nama_span"]').val("");
            $('#form-field').find('input[name="station_id"]').val("");
            $('#form-field').find('input[name="id"]').val("");
            $('#form-field').children('.modal').modal('show');
        } else if (mode == "edit") {

            $.ajax({
                url: "{{ url('/vendor') }}/" + data + "/edit",
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $('#form-field').find('input[name="nama_vendor"]').val(data.waktu_pinjam);
                    $('#form-field').find('input[name="foto"]').val(data.waktu_dikembalikan);
                    $('#form-field').find('input[name="kordinat"]').val(data.qty);
                    $('#form-field').find('input[name="id"]').val(data.id);

                }
            })
            $('#form-field').children('.modal').find('.modal-title').text("Edit Vendor");
            $('#form-field').children('.modal').modal('show');

        } else if (mode == "hapus"){
            $('#form-field-hapus').children('.modal').find('.modal-title').text("Hapus Vendor");
            $('#form-field-hapus').find('input[name="id_vendor"]').val(data);
            $('#form-field-hapus').children('.modal').modal('show');
        }
    }

    function reset_default() {
        $('#form-field')[0].reset();
        $('#form-field').find('input[name="id"]').val('');
        mode = undefined;
        $('#list-span').html('');
        $('#form-field').children('.modal').modal('hide');
        showData();
    }

    function reset_default_hapus() {
        $('#form-field-hapus')[0].reset();
        $('#form-field-hapus').find('input[name="id_transaksi"]').val('');
        mode = undefined;
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
		if (action == "add") {
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

            var id = $("input[id='id_span']").val();
            if (id == "") {
                var tipe = "POST";
            } else {
                var tipe = "PUT";
                var ids = "/"+id;
            }

            $.ajax({
                url: "{{ url('/insertSpan') }}" + ids,
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
