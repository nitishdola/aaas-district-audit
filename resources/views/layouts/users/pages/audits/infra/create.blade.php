@extends('layouts.users.default')
@section('main_content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header mt-3">
                <h3 class="card-title">Infrastructure Audit Form</h3>
            </div>
                @if ($errors->any())
                    {!! implode('', $errors->all('
						<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
						  <span class="font-medium">Oops !</span> ::message
						</div>
					')) !!}
                @endif
                {!! Form::open(array('route' => 'audit.infrastructure.save', 'id' => 'audit.infrastructure.save', 'files' => true)) !!}
            <div class="card-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Latitude</label>
                            {!! Form::text('latitude', null, ['class' => 'form-control col-md-12', 'readonly' => 'readonly', 'placeholder' => 'Latitude', 'id' => 'latitude', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Longitude</label>
                            {!! Form::text('longitude', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'longitude', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hospital</label>
                            {!! Form::select('hospital_id', $hospitals, null, ['class' => 'form-control form-control-chosen-required', 'placeholder' => 'Select Hospital', 'id' => 'hospital_id', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="form-group">
                            <label>Date of Audit</label>
                            {!! Form::text('date_of_audit', null, ['class' => 'form-control datepicker', 'id' => 'date', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="district_name">
                            <label>District</label>
                            {!! Form::text('district', null, ['class' => 'form-control', 'disabled' => true, 'id' => 'district_id', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="form-group" id="district_name_loading" style="display:none;">
                            Fetching District Name...
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Existence of Hospital</label><br>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" 
                                            type="radio" 
                                            name="existence_of_hospital" 
                                            id="exyes" 
                                    value=1>
                                        YES
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="exno">
                                <input class="form-check-input" 
                                            type="radio" 
                                            name="existence_of_hospital" 
                                            id="exno" 
                                            value=0>
                                No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Infrastructure Empanelled as per Specialty</label><br>
                            <div class="form-check form-check-inline">
                                
                                <label class="form-check-label" for="emp_spec_yes">
                                <input class="form-check-input" type="radio" name="infrastructure_empanelled_as_per_specialty" id="emp_spec_yes" value=1>    
                                Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                
                                <label class="form-check-label" for="emp_spec_no">
                                <input class="form-check-input" type="radio" name="infrastructure_empanelled_as_per_specialty" id="emp_spec_no" value=0>
                                No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>If No, Remarks</label><br>
                            {!! Form::textarea('infrastructure_remarks', null, ['class' => 'form-control', 'id' => 'infrastructure_remarks', 'rows' => 3, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Manpower Exists as per Specialty</label><br>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" 
                                            type="radio" 
                                            name="manpower_exist_as_per_specialty" 
                                            id="man_yes" 
                                    value=1>
                                        YES
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="exno">
                                <input class="form-check-input" 
                                        type="radio" 
                                        name="manpower_exist_as_per_specialty" 
                                        id="man_no" 
                                    value=0>
                                No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>If No, Remarks</label><br>
                            {!! Form::textarea('manpower_remarks', null, ['class' => 'form-control', 'id' => 'manpower_remarks', 'rows' => 3, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                            <label>Remarks*</label><br>
                            {!! Form::textarea('remarks', null, ['class' => 'form-control', 'id' => 'remarks', 'rows' => 3, 'autocomplete' => 'off', 'required' => true]) !!}
                        </div>
                    </div>
                </div>

                <div class="row attachment">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Attachment Name</label>
                            {!! Form::text('attachment_names[]', null, ['class' => 'form-control', 'id' => 'attachment_names', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>.</p>
                            <label>Upload Document</label>
                            {!! Form::file('attachments[]', null, ['class' => 'form-control', 'id' => 'attachment_names', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary add_more_attachment"><i class="fas fa-plus-circle"></i> Add More Attachment</a>
                    </div>
                </div>

                

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label></lable>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@stop

@section('pageCss')
<link href="
https://cdn.jsdelivr.net/npm/bootstrap-chosen@1.4.2/bootstrap-chosen.min.css
" rel="stylesheet">
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
</style>
@stop

@section('pageJs')
<script src="
https://cdn.jsdelivr.net/npm/bootstrap-chosen@1.4.2/dist/chosen.jquery-1.4.2/chosen.jquery.min.js
"></script>
<script>
    $(".form-control-chosen-required").chosen({no_results_text: "Oops, nothing found!"}); 
</script>
<script>

    $(document).ready(function() {
        getLocation();
    });

    getLocation = function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    
    function showPosition(position) {

        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
    }

    $('.add_more_attachment').click(function(e) {
        var last_clone = $('.attachment:last');
        var clone = $('.attachment:last').clone();
        clone.find("input").val("");
        last_clone.after(clone);
    });

    


    $('#hospital_id').change(function(e) {
        $this = $('#hospital_id');

        if($this.val() != '') {
            var data = url = '';

            data += '&hospital_id='+$this.val();
            url += "{{ route('get_district') }}";

            $('#district_name').hide();
            $('#district_name_loading').show();

            $.ajax({
                data : data,
                url : url,
                type : 'GET',

                success : function(resp) {
                    $('#district_id').val(resp.district.name);
                    $('#district_name').show();
                    $('#district_name_loading').hide();
                }
            });
        }
    });
</script>
@stop