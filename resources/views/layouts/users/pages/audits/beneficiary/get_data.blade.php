@extends('layouts.users.default')
@section('main_content')
<div class="content-wrapper">
    <div class="row">
    @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Benefciary Audit Data Received</h4>
            
            <div class="col-md-12 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Patient Name</th>
                                    <th>Contact Number</th>
                                    <th>District</th>
                                    <th>PMJAY ID</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th width="10%">Case Number</th>
                                    <th>Hospital</th>
                                    <th>Preauth Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($content as $k => $v)
                                
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $v['patient_name'] }}</td>
                                    <td>{{ $v['contact_no'] }}</td>
                                    <td>{{ $v['district_name']}}</td>
                                    <td>{{ $v['card_no'] }}</td>
                                    <td>{{ $v['age'] }}</td>
                                    <td>{{ $v['gender'] }}</td>
                                    <td>{{ $v['case_no'] }}</td>
                                    <td>{{ $v['hosp_name'] }}</td>
                                    <td>{{ date('d-m-Y', strtotime($v['cs_preauth_dt'])) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        </div>
        </div>
    </div>
</div>

@stop