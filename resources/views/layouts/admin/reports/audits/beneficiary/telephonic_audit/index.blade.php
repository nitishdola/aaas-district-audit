@extends('layouts.admin.default')

@section('main_content')

<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title">Home Visit Report</h5>

                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Date of Audit</th>
                    <th scope="col">Auditor Name</th>
                    <th scope="col">Beneficiary Name</th>
                    <th scope="col">District</th>
                    <th scope="col">Hospital Name</th>
                    <th scope="col">Audit Finding</th>
                    <th scope="col">Audit Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $k => $v)
                    <tr>
                        <td>{{ $k + $results->firstItem()}}</td>
                        <td>{{ date('d-m-Y', strtotime($v->date_of_audit)) }}</td>
                        <td>{{ $v->user->name}}</td>
                        <td>{{ $v->tms_data_record->patient_name}}</td>
                        <td>{{ $v->tms_data_record->district_name}}</td>
                        <td>{{ $v->tms_data_record->hosp_name}}</td>
                        <td>{{ $v->telephonic_audit_finding }}</td>
                        <td>
                            <a href="{{ route('admin.audit.telephonic_audit.view_audit', Crypt::encrypt($v->id)) }}">
                                View
                            </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
                </table>

                <div class="d-flex">
                    {!! $results->links() !!}
                </div>

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
        <li class="breadcrumb-item active">Telephonic Audit Report</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop