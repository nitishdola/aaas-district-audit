@extends('layouts.users.default')
@section('main_content')



<div class="col-lg-12 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">{{ $result->hospital->name }} , {{ $result->hospital->district->name }} </h4>
         <p class="card-description">
         Audit Date :  <code>{{ date('d-m-Y', strtotime($result->date_of_audit)) }}</code>
         </p>
         <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Existence of Hospital</th>
                        <td>@if($result->existence_of_hospital) YES @else NO @endif</td>
                    </tr>
                    <tr>
                        <th>Infrastructure Empanelled as per Specialty</th>
                        <td>@if( $result->infrastructure_empanelled_as_per_specialty)  YES @else NO @endif</td>
                    </tr>
                    <tr>
                        <th>If No, Remarks</th>
                        <td>{{ $result->infrastructure_remarks }}</td>
                    </tr>
                    <tr>
                        <th>Manpower exisis as per Specialty</th>
                        <td>@if($result->manpower_exist_as_per_specialty) YES  @else NO @endif</td>
                    </tr>
                    <tr>
                        <th>If No, Remarks</th>
                        <td>{{ $result->manpower_remarks }}</td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>{{ $result->remarks }}</td>
                    </tr>
                </thead>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Attachments</h4>
            @foreach($result->attachments as $k => $v)
            <div class="col-md-2">
                <div class="mt-3">
                    @php $path = "storage/$v->attachment_path"; @endphp
                    <a data-fancybox data-type="iframe" data-src="{{ asset($path) }}" href="javascript:;">
                    {{ $v->attachment_name }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row" style="height:300px">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Location</h4>
            <div id="map"></div>
        </div>
        </div>
    </div>
    
</div>


@stop

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js" integrity="sha512-jGR1T3dQerLCSm/IGEGbndPwzszJBlKQ5Br9vuB0Pw2iyxOy+7AK+lJcCC8eaXyz/9du+bkCy4HXxByhxkHf+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS7ngGD4Xesm8Ec9EArp0qG7dD-x11mT8&callback=initMap&v=weekly"
   defer
   ></script>
<script>
    const latitude = {{ $result->latitude }};
    const longitude = {{ $result->longitude }};
    
   function initMap() {
     const myLatLng = { lat: latitude, lng: longitude };
     const map = new google.maps.Map(document.getElementById("map"), {
       zoom: 16,
       center: myLatLng,
     });
   
     new google.maps.Marker({
       position: myLatLng,
       map,
       title: "Hello World!",
     });
   }
   
   window.initMap = initMap;
</script>
@stop
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   #map {
   height: 100%;
   }
</style>
@stop