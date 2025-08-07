@extends('layouts.admin')
@section('title', 'Home')
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
                            <h4 class="black-color">{{$vendor->nama_vendor}} - {{$lokasi->nama_lokasi}}</h4>
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
           
@endsection
@section('script')
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
        var id = pathArray[4];
        $.ajax({
            url: "{{ url('/listLokasiSpan') }}/"+id,
            dataType: "json",
            async: false,
            type: "GET",
            success: function(data) {	
                $('#list-span').html('');	
                $.each(data.items, function(index, item) {
                    $('#list-span').append('<div class="col-lg"><a href="{{ url("/home")}}/'+id+'/live_sensor "><div class="loc-sensor"><div class="list-sensor spanDrag" id="span_'+item.id+'" style="inset:'+item.y+'px auto auto '+item.x+'px;""><img src="{{ url("/assets") }}/img/'+item.status+'.png"><h5>'+item.no+'</h5></div></div></a></div>');
                });	
            }
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
        var id = pathArray[4];

        $.ajax({
            url: "{{ url('/listLokasiSpan') }}/"+id,
            dataType: "json",
            async: false,
            type: "GET",
            success: function(data) {		
                $.each(data.items, function(index, item) {
                    $("#span_"+item.id).html('<img src="{{ url("/assets") }}/img/'+item.status+'.png"><h5>'+item.no+'</h5>');
                });	
            }
        });
    }
</script>
@endsection