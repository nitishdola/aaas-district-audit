@extends('layouts.users.default')
@section('main_content')
<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header mt-3">
                <h3 class="card-title">Benefciary Audit</h3>
            </div>
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif

                {!! Form::open(array('route' => 'audit.beneficiary.view_all_data', 'id' => 'audit.beneficiary.view_all_data', 'method' => 'GET')) !!}
            <div class="card-body">
                <div class="row">

                
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Preauth Range</label>
                            <select class="form-control" name="preauth_range" >
                                <option value="">Select Preauth Date Range</option>
                                @foreach($tms_data as $k => $v)
                                    <option 
                                            value="{{ $v->id }}"
                                            @if($v->id == $request->preauth_range)
                                            selected="selected"
                                            @endif
                                    >
                                    
                                    {{ date('d-m-Y', strtotime($v->period_from)).' - '.date('d-m-Y', strtotime($v->period_to)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="col-md-6 mt-4">
                    <input type="hidden" name="search" value="yes" />
                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        @if(count($result)):
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Patient Name</th>
                            <th>Contact Number</th>
                            <th>Dsitrict</th>
                            <!-- <th>Hospital</th> -->
                            <th>Preauth Date</th>
                            <!-- <th>Procedure</th> -->
                            <th>Audit Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($result as $k => $v)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>
                                <a href="{{ route('audit.beneficiary.view_details', Crypt::encrypt($v->id)) }}" class="btn btn-link">
                                    {{ $v->patient_name }}
                                </a>
                            </td>
                            
                            <td>{{ $v->contact_no }}</td>
                            <td>{{ $v->district_name }}</td>
                            <!-- <td style="width:10%">{{ $v->hosp_name }}</td> -->
                            <td>{{ $v->cs_preauth_dt }}</td>
                            <!-- <td>{{ $v->dis_main_name }}</td> -->
                            <td width="10%">
                                @if(!$v->telephonic_audit_completed)
                                <a href="{{ route('audit.beneficiary.telephonic_audit', Crypt::encrypt($v->id)) }}" target="_blank" class="btn btn-link">
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                </a>
                                @endif

                                @if(!$v->home_visit_completed)
                                <a href="{{ route('audit.beneficiary.home_visit', Crypt::encrypt($v->id)) }}" target="_blank">    
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</section>
@stop