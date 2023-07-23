@extends('layouts.users.default')
@section('main_content')



<div class="col-lg-12 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <h4 class="card-title">{{ $result->tms_data_record->patient_name }} </h4>
               <p class="card-description">
                  Audit Date :  <code>{{ date('d-m-Y', strtotime($result->date_of_audit)) }}</code>
               </p>
            </div>
            <div class="col-md-6">
            </div>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>PMJAY ID</th>
                     <td>{{ $result->tms_data_record->card_no }}</td>
                  </tr>
                  <tr>
                     <th>Scheme</th>
                     <td>{{ $result->tms_data_record->hhd_type }}</td>
                  </tr>
                  <tr>
                     <th>Beneficiary District</th>
                     <td>{{ $result->tms_data_record->district_name }}</td>
                  </tr>
                  <tr>
                     <th>Hospital Name</th>
                     <td>{{ $result->tms_data_record->hosp_name }}</td>
                  </tr>
                  <tr>
                     <th>Hospital District</th>
                     <td>{{ $result->tms_data_record->hospdist }}</td>
                  </tr>
                  <tr>
                     <th>Preauth Amount</th>
                     <td>{{ $result->tms_data_record->preauth_raised_amt }}</td>
                  </tr>
                  <tr>
                     <th>Telephonic Audit Finding</th>
                     <td>{{ $result->telephonic_audit_finding }}</td>
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
         
         <hr>
         @foreach($result->attachments as $k => $v)
         <div class="col-md-6">
            <div class="mt-3">
               @php $path = "$v->attachment_path"; @endphp
               <a data-fancybox data-type="iframe" data-src="{{ asset($path) }}" href="javascript:;">
               {{ $v->attachment_name }}
               </a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>


@stop

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js" integrity="sha512-jGR1T3dQerLCSm/IGEGbndPwzszJBlKQ5Br9vuB0Pw2iyxOy+7AK+lJcCC8eaXyz/9du+bkCy4HXxByhxkHf+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stop
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   #map {
   height: 100%;
   }
   
</style>
@stop