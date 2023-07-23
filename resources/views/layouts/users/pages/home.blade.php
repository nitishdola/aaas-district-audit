@extends('layouts.users.default')

@section('main_content')

<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Welcome {{ ucfirst(auth()->user()->name) }}</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">Home Visit</p>
              <p class="fs-30 mb-2">{{ $home_visit }}</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4">Telephonic Audit</p>
              <p class="fs-30 mb-2">{{ $telephonic_audit }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Infrastructure Audits</p>
              <p class="fs-30 mb-2">
                <a href="{{ route('audit.infrastructure.index') }}">
                {{ $infra_audits }}
                </a>
              </p>
              
            </div>
          </div>
        </div>
        <div class="col-md-6 stretch-card transparent">
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">Reports</p>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('pageCss')
<style>
  p.fs-30 a { color : #FFFFFF; }
</style>
@stop