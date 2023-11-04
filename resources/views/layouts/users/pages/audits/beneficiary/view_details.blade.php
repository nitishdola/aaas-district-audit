@extends('layouts.users.default')
@section('main_content')

<section class="content mt-3">
   <div class="container-fluid">
       <div class="card card-default">
           @if ($errors->any())
           {!! implode('', $errors->all('
           <div class="alert alert-danger">:message</div>
           ')) !!}
           @endif
           <div class="card card-primary">
               <div class="card-header">
                   <h3 class="card-title">Benefciary Details <strong>{{ $beneficiary_data->case_no }}</strong></h3>
               </div>
               <div class="card-body">
                   <table class="table table-bordered">
                        <tr>
                            <th>Patient Name</th>
                            <td>{{ $beneficiary_data->patient_name }}</td>

                            <th>Card Number</th>
                            <td>{{ $beneficiary_data->card_no }}</td>
                        </tr>

                        <tr>
                            <th>Scheme</th>
                            <td>{{ $beneficiary_data->hhd_type }}</td>

                            <th>Age</th>
                            <td>{{ $beneficiary_data->age }}</td>
                        </tr>

                        <tr>
                            <th>Gender</th>
                            <td>{{ $beneficiary_data->gender }}</td>

                            <th>Contact Number</th>
                            <td>{{ $beneficiary_data->contact_no }}</td>
                        </tr>

                        <tr>
                            <th>District</th>
                            <td>{{ $beneficiary_data->district_name }}</td>

                            <th>State</th>
                            <td>{{ $beneficiary_data->pat_state }}</td>
                        </tr>

                        <tr>
                            <th>Hospital</th>
                            <td colspan="3">{{ $beneficiary_data->hosp_name }} ({{ $beneficiary_data->hosp_disp_code }})</td>
           </tr>
           <tr>
                            <th>Hospital District</th>
                            <td>{{ $beneficiary_data->hospdist }}</td>
                        </tr>

                        <tr>
                            <th>Hospital Type</th>
                            <td>{{ $beneficiary_data->hosp_type }}</td>

                            <th>Case No</th>
                            <td>{{ $beneficiary_data->case_no }}</td>
                        </tr>

                        <tr>
                            <th>Case Registration Date</th>
                            <td>{{ $beneficiary_data->case_regn_date }}</td>

                            <th>Discharge Date</th>
                            <td>{{ $beneficiary_data->cs_dis_dt }}</td>
                        </tr>

                        <tr>
                            <th>Preauth Date</th>
                            <td>{{ $beneficiary_data->cs_preauth_dt }}</td>

                            <th>Preauth Raised Amount</th>
                            <td>{{ $beneficiary_data->preauth_raised_amt }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{ $beneficiary_data->status }}</td>

                            <th>Category Code</th>
                            <td>{{ $beneficiary_data->category_disp_code }}</td>
                        </tr>

                        <tr>
                            <th>Category</th>
                            <td>{{ $beneficiary_data->dis_main_name }}</td>

                            <th>Procedure Code</th>
                            <td>{{ $beneficiary_data->procedure_disp_id }}</td>
                        </tr>

                        <tr>
                            <th>Procedure Name</th>
                            <td colspan="3">{{ $beneficiary_data->procedure_name }}</td>
                        </tr>
                   </table>
               </div>
           </div>
       </div>
   </div>
</section>

@stop
@section('pageCss')
<style>
   table {border-collapse:collapse; table-layout:fixed;}
   table td {border:solid 1px #fab; width:250px; word-wrap:break-word;}
   </style>
@stop
