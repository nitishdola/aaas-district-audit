@extends('layouts.users.default')
@section('main_content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Benefciary Audit Form</h4>
            <p class="card-description">
                Fetch Data from SDWH Server
            </p>
            {!! Form::open(array('route' => 'audit.beneficiary.get_data', 'id' => 'audit.beneficiary.get_data')) !!}
            
            <div class="form-group">
                <label for="district">Select District</label>
                {!! Form::select('district', $districts, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select District', 'id' => 'hospital_id', 'required' => true, 'autocomplete' => 'off']) !!}
            </div>

            <div class="form-group">
                <label for="date_from">Preauth Date From</label>
                <div class="input-group mb-2 mr-sm-2">
                    {!! Form::text('date_from', null, ['class' => 'form-control col-12 datepicker', 'id' => 'date_from', 'required' => true, 'autocomplete' => 'off']) !!}
                </div>
            </div>
            
            <label for="date_to">Preauth Date From</label>
            <div class="input-group mb-2 mr-sm-2">
                
                {!! Form::text('date_to', null, ['class' => 'form-control datepicker', 'id' => 'date_to', 'required' => true, 'autocomplete' => 'off']) !!}
            </div>


            <label for="hosp_type">Hospital Type</label>
            @php
                                $hosp_types = [];
                                $hosp_types['GOI'] = 'GOI';
                                $hosp_types['Private'] = 'Private';
                                $hosp_types['Public'] = 'Public';
                            @endphp
                            {!! Form::select('hosp_type', $hosp_types, null, ['class' => 'form-control select2 col-md-12', 'placeholder' => 'Select Hospital Type', 'id' => 'hosp_type', 'required' => true, 'autocomplete' => 'off']) !!}

            <button type="submit" class="btn btn-primary mt-2 mb-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
    
    
    
    </div>
</div>
@stop

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('input.datepicker').Zebra_DatePicker();
</script>
@stop

@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/metallic/zebra_datepicker.min.css" integrity="sha512-VeBd1mVDXcj9onaSbaf8Z/fJVd7qR08qMtdSDttUN8ds+75TZ+fb6vkjltv26K7FjedTDl1wteDyS99UnHhzDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop