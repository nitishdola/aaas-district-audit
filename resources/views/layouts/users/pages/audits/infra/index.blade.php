@extends('layouts.users.default')
@section('main_content')
<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header mt-3">
                <h3 class="card-title">Infrastructure Audit Search</h3>
            </div>
            {!! Form::open(array('route' => 'audit.infrastructure.index', 'id' => 'audit.infrastructure.index', 'method' => 'GET')) !!}
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hospital</label>
                            {!! Form::select('hospital_id', $hospitals, null, ['class' => 'form-control select2 col-md-12', 'placeholder' => 'Select Hospital', 'id' => 'hospital_id']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date of Audit From</label>
                            {!! Form::text('date_of_audit_from', null, ['class' => 'form-control datepicker', 'id' => 'date_of_audit_from',  'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date of Audit To</label>
                            {!! Form::text('date_of_audit_to', null, ['class' => 'form-control datepicker', 'id' => 'date_of_audit_to',  'autocomplete' => 'off']) !!}
                        </div>
                    </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>


<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header mt-3">
                <h3 class="card-title">Results</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($results))
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl</th>
                                <th>Hospital Name</th>
                                <th>District</th>
                                <th>Date of Audit</th>
                                <th>Details</th>
                            </tr>
                            @foreach($results as $k => $v)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $v->hospital->name }}</td>
                                <td>{{ $v->hospital->district->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($v->date_of_audit)) }}</td>
                                <td><a href="{{ route('audit.infrastructure.view_audit', $v->id) }}">View</a></td>
                            </tr>
                            @endforeach
                        </table>

                        <div class="d-flex">
                                {!! $results->links() !!}
                        </div>
                        

                        @else
                        <div class="alert alert-warning">No Records Found !</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('pageCss')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -10px !important;
    }
    
</style>
@stop

@section('pageJs')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@stop
