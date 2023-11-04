@extends('layouts.admin.default')

@section('main_content')

<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title">Add new DMO</h5>

                {!! Form::open(['route' => 'admin.dmo.save']) !!}
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                            {!! Form::text('name', [
                                'class'     => 'form-control', 
                                'id'        => 'name', 
                                'disabled'  => true, 
                                'required'  => true, 
                                'autocomplete' => 'off'
                            ]) !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-6">
                        {!! Form::text('username', ['class' => 'form-control', 'id' => 'username', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    
                    
                    <div class="row mb-3">
                    <label for="inputTime" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">SAVE</button>
                    </div>
                    </div>
                    {!! Form::save() !!}

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
        <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop