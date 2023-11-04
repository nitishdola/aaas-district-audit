@extends('layouts.admin.default')

@section('main_content')
<div class="col-lg-10">

    <div class="card">
    <div class="card-body">
        <h5 class="card-title">General Form Elements</h5>

        <!-- General Form Elements -->
        {!! Form::open(array('route' => 'admin.daily_activity.view_users_activity', 'id' => 'admin.activity.view_users')) !!}
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Select DMO</label>
            <div class="col-sm-6">
            {!! Form::select('user_id', $users, null, ['class' => 'form-control col-md-12', 'placeholder' => 'Select User', 'required' => true, 'autocomplete' => 'off']) !!}
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Select Month</label>
            <div class="col-sm-6">
            <input type="text" name="month" id="zdate" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>

        {!! Form::close() !!}<!-- End General Form Elements -->

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
        <li class="breadcrumb-item active">Home Visit Report</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/2.0.0/zebra_datepicker.min.js" integrity="sha512-Qnfn6vHrOEl6m6mBMVxKUScok5y+Apdw+3tDNpdeEHlh7/uiZ7+H0VkxLlumrj9ePNcEOA/t5vV/3NgcF44QnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#zdate').Zebra_DatePicker({
        view: 'years',
        format: 'M-Y'
    });
</script>
@stop

@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/2.0.0/css/bootstrap/zebra_datepicker.css" integrity="sha512-g0wc6i41NM+cFE1XCp5p45D2FHSfM8676LFfxGEGFoQbmKxzP3Q/jQnw6V8zJT49IY4YDR2xpRuHGsQxx1gaHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop