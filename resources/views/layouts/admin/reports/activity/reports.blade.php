@extends('layouts.admin.default')

@section('main_content')
<div class="row">
<div class="col-md-12">
            <div id="mapCanvas" style="width: 100%; height: 400px;"></div>
        </div>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title">Date : {{ date('d-m-Y', strtotime($date)) }} User : {{ $user }}</h5>

                @php 
                    $lat_long = [];
                    $lat_longs = [];

                @endphp
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Time</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Remarks</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($acitivities as $k => $v)
                    <tr>
                        <td>{{ $k + 1 }}</td>
                        <td>{{ date('h:i A', strtotime($v->activity_date)) }}</td>
                        <td>{{ $v->activity}} {{ $v->other_activity_name}}</td>
                        <td>{{ $v->activity_remarks}}</td>
                        <td></td>
                    </tr>
                        @php 
                            $lat_long = array($v->latitude.','.$v->longitude);
                            $lat_longs[] = $lat_long;
                        @endphp
                        
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div><!-- End Recent Sales -->

        
    </div>
</div><!-- End Left side columns -->



@stop

@section('breadcumb')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop

@section('pageJs')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS7ngGD4Xesm8Ec9EArp0qG7dD-x11mT8&callback=initMap&v=weekly"
   defer
   >
</script>
<script>
    function initMap() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };
                        
        // Display a map on the web page
        map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
        map.setTilt(50);
            
        // Multiple markers location, latitude, and longitude
        /*var markers = [
            [40.671349546127146, -73.96375730105808],
            [40.67254944015601, -73.9682162170653],
            [40.66427511834109, -73.96512605857858],
            [40.68268267107631, -73.97546296241961]
        ];*/

        var markers = {!! str_replace('"', '', json_encode($lat_longs)) !!};

        

        // Add multiple markers to map
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        
        // Place each marker on the map  
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map
                //title: markers[i][0]
            });

            console.log(marker)
            
            // Add info window to marker    
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    //infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Center the map to fit all markers on the screen
            map.fitBounds(bounds);
        }

        // Set zoom level
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(12);
            google.maps.event.removeListener(boundsListener);
        });
    }

    window.initMap = initMap;
</script>

@stop