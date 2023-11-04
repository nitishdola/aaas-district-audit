@extends('layouts.admin.default')

@section('main_content')

<div class="col-lg-12">
   <div class="row">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
            <h5 class="card-title">Infrastructure Audit Report</h5>
            <table class="table table-bordered">
                    <tr>
                        <th scope="col">Date of Audit</th>
                        <td>{{ date('d-m-Y', strtotime($home_visit->date_of_audit)) }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Auditor</th>
                        <td>{{ $home_visit->user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Patient Name</th>
                        <td>{{ $home_visit->tms_data_record->patient_name }}, {{ $home_visit->tms_data_record->district_name }} </td>
                    </tr>

                    <tr>
                        <th scope="col">Hospital Name</th>
                        <td>{{ $home_visit->tms_data_record->hosp_name }} </td>
                    </tr>

                    <tr>
                        <th scope="col">Cashless Treatment</th>
                        <td>{{ $home_visit->cashless_treatment }} 
                            @if($home_visit->cashless_treatment == 'No')
                            @php 
                                $cashless_treatment_path = '';
                                $cashless_treatment_path = "audit/home_visit/$home_visit->user_id/$home_visit->photo_of_beneficiary"; 
                            @endphp
                            <a data-fancybox data-type="iframe" data-src="{{ asset($cashless_treatment_path) }}" href="javascript:;"> Cash Memo </a>
                            @endif
                        </td>
                    </tr>
                <tr>
                    <th scope="col">Beneficiary Satisfied with Treatment</th>
                    <td>
                        {{ $home_visit->beneficiary_satisfied_with_treatment }}
                    </td>
                </tr>

                <tr>
                        <th scope="col">Beneficiary Photo</th>
                        <td>
                            @php 
                                $home_visit_path = '';
                                $home_visit_path = "audit/home_visit/$home_visit->user_id/$home_visit->photo_of_beneficiary"; 
                            @endphp
                            <a data-fancybox data-type="iframe" data-src="{{ asset($home_visit_path) }}" href="javascript:;"> Photo </a>
                        </td>
                </tr>
                
                <tr>
                    <th scope="col">Remarks</th>
                    <td>{{ $home_visit->remarks }}</td>
                </tr>
            </table>
            </div>
        </div>
    </div>

      
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Attachments</h4>
                    @foreach($home_visit->attachments as $k => $v)
                    <div class="col-md-2">
                        <div class="mt-3">
                            @php 
                            $path = '';
                            $path = "storage/$v->attachment_path"; 
                            @endphp
                            <a data-fancybox data-type="iframe" data-src="{{ asset($path) }}" href="javascript:;">
                                {{ $v->attachment_name }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>

      
   </div>
</div>





@stop

@section('breadcumb')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.audit.home_visit.index') }}">View All Home Visit</a></li>
        <li class="breadcrumb-item active">Home Visit Report</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js" integrity="sha512-jGR1T3dQerLCSm/IGEGbndPwzszJBlKQ5Br9vuB0Pw2iyxOy+7AK+lJcCC8eaXyz/9du+bkCy4HXxByhxkHf+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS7ngGD4Xesm8Ec9EArp0qG7dD-x11mT8&callback=initMap&v=weekly"
   defer
   ></script>
<script>
    const latitude = {{ $home_visit->latitude }};
    const longitude = {{ $home_visit->longitude }};
    
   function initMap() {
     const myLatLng = { lat: latitude, lng: longitude };
     const map = new google.maps.Map(document.getElementById("map"), {
       zoom: 16,
       center: myLatLng,
     });
   
     new google.maps.Marker({
       position: myLatLng,
       map,
       title: "",
     });

     console.log(map)
   }
   
   window.initMap = initMap;
</script>
@stop
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   #map {
   height: 400px;
   }
</style>
@stop