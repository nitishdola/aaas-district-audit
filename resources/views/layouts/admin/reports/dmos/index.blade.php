@extends('layouts.admin.default')

@section('main_content')

<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title">All DMOs</h5>

                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Number of Home Visits</th>
                    <th scope="col">Number of Telephonic Audit</th>
                    <th scope="col">Number of Infrastructure Audits</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $k => $v)
                    <tr>
                        <td>{{ $k + 1 }}</td>
                        <td>{{ $v->name}}</td>
                        <td>{{ $v->username }}</td>
                        <td>{{ count($v->homeVisit) }}</td>
                        <td>{{ count($v->telephonicAudit) }}</td>
                        <td>{{ count($v->infrastructureAudit) }}</td>
                        
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
        <li class="breadcrumb-item active">All DMOs</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop