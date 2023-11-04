@extends('layouts.admin.default')

@section('main_content')

<div class="col-lg-12">
    <div class="row">

    <!-- Sales Card -->
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">

        <div class="card-body">
            <h5 class="card-title">Infrastructure <span>Audit</span></h5>

            <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-hospital"></i>
            </div>
            <div class="ps-3">
                <h6>{{ $infra_audits }}</h6>
            </div>
            </div>
        </div>

        </div>
    </div><!-- End Sales Card -->

    <!-- Revenue Card -->
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">
        <div class="card-body">
            <h5 class="card-title">Telephonic <span>| Audit</span></h5>

            <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-telephone-forward-fill"></i>
            </div>
            <div class="ps-3">
                <h6>{{ $telephonic_audit }}</h6>
            </div>
            </div>
        </div>

        </div>
    </div><!-- End Revenue Card -->

    <!-- Customers Card -->
    <div class="col-xxl-4 col-xl-12">

        <div class="card info-card customers-card">

        <div class="card-body">
            <h5 class="card-title">Home <span>| Visit</span></h5>

            <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-signpost-fill"></i>
            </div>
            <div class="ps-3">
                <h6>{{ $home_visit }}</h6>
               
            </div>
            </div>

        </div>
        </div>

    </div><!-- End Customers Card -->
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

        <div class="card-body">
            <h5 class="card-title">Recent Home Visits</h5>

            <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">Case Number</th>
                <th scope="col">Auditor</th>
                <th scope="col">Beneficiary Name & District</th>
                <th scope="col">Contact No</th>
                <th scope="col">Preauth date & Amount</th>
                <th scope="col">Cashless</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latest_home_visits as $k => $v)
                <tr>
                    <td scope="row"><a href="#">{{ $v->tms_data_record->case_no }}</a></td>
                    <td>{{ $v->user->name }}</td>
                    <td>{{ $v->tms_data_record->patient_name }}, {{ $v->tms_data_record->district_name }}</td>
                    <td>{{ $v->tms_data_record->contact_no }}</td>
                    <td>{{ $v->tms_data_record->cs_preauth_dt }}, {{ $v->tms_data_record->preauth_raised_amt }} </td>
                    <td>
                        @if($v->cashless_treatment == 'No')
                        <span class="badge bg-danger">
                        @else
                        <span class="badge bg-success">
                        @endif
                        {{ $v->cashless_treatment }}</span></td>
                </tr>
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
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop