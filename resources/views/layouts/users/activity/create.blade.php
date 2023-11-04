@extends('layouts.users.default')
@section('main_content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header mt-3">
                <h3 class="card-title">Daily reporting</h3>
            </div>
                @if ($errors->any())
                    {!! implode('', $errors->all('
						<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400  alert-danger" role="alert">
						  <span class="font-medium">Oops !</span> :message
						</div>
					')) !!}
                @endif
                {!! Form::open(array('route' => 'daily_activity.store', 'id' => 'daily_activity.store')) !!}
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Latitude</label>
                            {!! Form::text('latitude', null, ['class' => 'form-control col-md-12', 'readonly' => 'readonly', 'placeholder' => 'Latitude', 'id' => 'latitude', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Longitude</label>
                            {!! Form::text('longitude', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'longitude', 'required' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Activity Date</label><br>
                            {!! Form::text('activity_date', date('d-m-Y'), ['class' => 'form-control', 'id' => 'activity_date', 'readonly' => true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reporting At</label><br>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="jt_dr_office">
                                    <input class="form-check-input" 
                                            type="radio" 
                                            name="activity" 
                                            id="jt_dr_office" 
                                    value="Jt. Director Office">
                                        Jt. Director Office
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="medical_college">
                                <input class="form-check-input" 
                                            type="radio" 
                                            name="activity" 
                                            id="medical_college" 
                                            value="Medical College">
                                Medical College</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="sha">
                                <input class="form-check-input" 
                                            type="radio" 
                                            name="activity" 
                                            id="sha" 
                                            value="SHA">
                                SHA</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="civil_hospital">
                                <input class="form-check-input" 
                                            type="radio" 
                                            name="activity" 
                                            id="civil_hospital" 
                                            value="Civil Hospital">
                                Civil Hospital</label>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="private_ehcp_yes">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="activity" 
                                                id="private_ehcp_yes" 
                                                value="Visit to private EHCP">
                                                Visit to private EHCP
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="ben_home_visit_yes">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="activity" 
                                                id="ben_home_visit_yes" 
                                                value="Beneficiary Home Visit">
                                                Beneficiary home visit
                                    </label>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="dc_office_visit_yes">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="activity" 
                                                id="dc_office_visit_yes" 
                                                value="Visit to DC office/Any other stakeholder office">
                                                Visit to DC office/Any other stakeholder office
                                    </label>
                                </div>
                                
                            </div>


                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="task_given_by_sha_yes">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="activity" 
                                                id="task_given_by_sha_yes_yes" 
                                                value="Task given by SHA">
                                                Task given by SHA
                                    </label>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="other_activity_yes">
                                        <input class="form-check-input" 
                                                type="radio" 
                                                name="activity" 
                                                id="other_activity_yes" 
                                                value="Others Activity">
                                                Others Activity, if any
                                    </label>
                                </div>
                                
                            </div>


                            <div class="form-group" id="other_activity_name">
                                <div class="form-check form-check-inline">
                                <label>Other activity Name</label>
                            {!! Form::text('other_activity_name', null, ['class' => 'form-control col-md-6',  'autocomplete' => 'off']) !!}
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Remarks</label><br>
                            {!! Form::textarea('activity_remarks', null, ['class' => 'form-control', 'id' => 'other_activity_remarks', 'rows' => 3, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label></lable>
                            <button type="submit" class="btn btn-success">Create Activity</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@stop

@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/bootstrap/zebra_datepicker.min.css" integrity="sha512-m/itLbtr4RKMErTLBb2BL6uQXIW1xBC3IXnlBe+/JTBktlOH5s5wpmsh0Z0D9zZs5wH1FKcNWF2za5njkkLEbQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
#other_activity_name {
    display : none;
}

</style>
@stop

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //$('#activity_date').Zebra_DatePicker();

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

    $('[name=activity]').click(function(){
        if ($("#other_activity_yes").is(":checked")) {
            $('#other_activity_name').show(600);
        }else{
            $('#other_activity_name').hide(300);
        }
    });
    

    
</script>
@stop