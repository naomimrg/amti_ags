@extends('layouts.admin')
@section('title', 'Dashboard')
@section('style')
<style>
 #map{ height: 350px }
 .marker-pin {
  width: 40px;
  height: 40px;
  border-radius: 50% 50% 50% 0;
  background: #c30b82;
  position: absolute;
  transform: rotate(-45deg);
  left: 50%;
  top: 50%;
  margin: -15px 0 0 -15px;
}

.marker-pin::after {
    /*content: '';
    width: 24px;
    height: 24px;
    margin: 3px 0 0 3px;
    background: #fff;
    position: absolute;
    border-radius: 50%;*/
 }

.custom-div-icon i {
   position: absolute;
   width: 22px;
   font-size: 22px;
   left: 0;
   right: 0;
   margin: 10px auto;
   text-align: center;
}
</style>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">

<script src='https://unpkg.com/leaflet@1.3.3/dist/leaflet.js
'></script>
@endsection
@section('content')
                    <div class="col-12">
                        <div class="row" style="height:100%;">
                            <div id="map"></div>
                            <div class="col-md-12" style="margin-top: 20px;">
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
            </div>
            <!-- / Content -->
@endsection
@section('script')
<script>
function showData(){
    $.ajax({
        url: "{{ url('/dashboard/listLokasi') }}",
        dataType: "json",
        async: true,
        type: "GET",
        success: function(data) {
            var map = L.map('map').setView([-2,120], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            $.each(data.items, function(index, item) {
                icon = L.divIcon({
                    className: 'custom-div-icon',
                    html: '<div id="'+item.id+'-'+item.slug+'" style="background-color:'+item.status+';" class="marker-pin"><center><img src="{{ url("/assets") }}/img/lokasi/'+item.image+'" style="width: 30px;height:30px;object-fit:cover;background:black;transform:rotate(45deg);margin-top: 5px;border-radius: 16px;"></center></div>',
                    iconSize: [30, 42],
                    iconAnchor: [15, 42]
                });
                L.marker([item.long, item.lat],{ icon: icon }).addTo(map)
                .bindPopup('<a href="{{ url("/vendor")}}/'+item.slug_vendor+'/'+item.slug+'">'+item.nama_lokasi+'</a>')
                .openPopup();
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
        status();
        realtime();
    }, 20000);
}

function status(){
    $.ajax({
        url: "{{ url('/dashboard/listLokasi') }}",
        dataType: "json",
        async: true,
        type: "GET",
        success: function(data) {
            $.each(data.items, function(index, item) {
                var id = item.id+'-'+item.slug;
                document.getElementById(id).style.backgroundColor = item.status;
            });
        }
    });
}

</script>
@endsection
