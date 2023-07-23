@extends('layouts.users.default')
@section('main_content')

<section class="content mt-3">
   <div class="container-fluid">
       <div class="card card-default">
           @if ($errors->any())
           {!! implode('', $errors->all('
           <div class="alert alert-danger">:message</div>
           ')) !!}
           @endif
           <div class="card card-primary">
               <div class="card-header">
                   <h3 class="card-title">Home Visit :: {{ $beneficiary_data->case_no }}</h3>
               </div>
               <div class="card-body">

                {!! Form::open(
                                array(
                                        'route' => ['audit.beneficiary.save_home_visit', Crypt::encrypt($beneficiary_data->id)],
                                        'id' => 'audit.beneficiary.get_data', 
                                        'files' => true
                                    )
                                ) 
                !!}

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
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Case No</label>
                                   {!! Form::text('case_no', $beneficiary_data->case_no, ['class' => 'form-control', 'id' => 'case_no', 'disabled' => true, 'required' => true, 'autocomplete' => 'off']) !!}
                               </div>
                           </div>
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Beneficiary Name</label>
                                   {!! Form::text('patient_name', $beneficiary_data->patient_name, ['class' => 'form-control', 'id' => 'patient_name', 'disabled' => true, 'required' => true, 'autocomplete' => 'off']) !!}
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-4">
                               <div class="form-group">
                                   <label>Contact No</label>
                                   {!! Form::text('contact_no', $beneficiary_data->contact_no, ['class' => 'form-control', 'id' => 'contact_no', 'disabled' => true, 'required' => true, 'autocomplete' => 'off']) !!}
                               </div>
                           </div>
                           <div class="col-sm-4">
                               <div class="form-group">
                                   <label>Name of the Hospital</label>
                                   {!! Form::text('hosp_name', $beneficiary_data->hosp_name, ['class' => 'form-control', 'id' => 'hosp_name', 'disabled' => true, 'required' => true, 'autocomplete' => 'off']) !!}
                               </div>
                           </div>
                           <div class="col-sm-4">
                               <div class="form-group">
                                   <label>Hospital District</label>
                                   {!! Form::text('hospdist', $beneficiary_data->hospdist, ['class' => 'form-control', 'id' => 'hospdist', 'disabled' => true, 'required' => true, 'autocomplete' => 'off']) !!}
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Address of the Beneficiary*</label>
                                   {!! Form::textarea('address_of_the_beneficiary', null, ['class' => 'form-control', 'id' => 'hospdist', 'rows' => 3, 'required' => true, 'autocomplete' => 'off']) !!}
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Whether the beneficiary is satisfied with the treatment ?*</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" required="required" type="radio" value="YES" name="satsfied">
                                        YES
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" required="required" type="radio" value="NO" name="satsfied">
                                        NO
                                    </label>
                                    </div>
                                </div>
                                </div>
                            </div>

                           <div class="col-md-6">
                               <div class="custom-file">
                                   <input type="file" required="required" name="beneficiary_photo" class="custom-file-input" id="customFile">
                                   <label class="custom-file-label" for="customFile">Photo of the beneficiary</label>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-6">
                               <!-- <div class="form-group">
                                   <label>Whether the treatment was cashless ?*</label>
                                   <div class="form-check">
                                       <input class="form-check-input" required="required" type="radio" value="YES" name="cashless">
                                       <label class="form-check-label">YES</label>
                                   </div>
                                   <div class="form-check">
                                       <input class="form-check-input" required="required" type="radio" value="NO" name="cashless">
                                       <label class="form-check-label">NO</label>
                                   </div>
                               </div> -->


                               <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Whether the treatment was cashless ?*</label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" required="required" type="radio" value="YES" name="cashless">
                                            YES
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" required="required" type="radio" value="NO" name="cashless">
                                            NO
                                        </label>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                           </div>
                           <div class="col-md-6">
                               <div class="custom-file">
                                   <input type="file" name="cash_memo" class="custom-file-input" id="customFile">
                                   <label class="custom-file-label" for="customFile">If No, upload cash memo, money receipt etc</label>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Remarks*</label>
                                   {!! Form::textarea('remarks', null, ['class' => 'form-control', 'id' => 'hospdist', 'rows' => 3, 'required' => true, 'autocomplete' => 'off']) !!}
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
                               <a href="javascript:void(0)" class="btn btn-sm btn-primary add_more_attachment"><i class="fa fa-plus" aria-hidden="true"></i> Add More Attachment</a>
                           </div>
                       </div>

                       <div class="row mt-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label></label>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>

                       {!! Form::close() !!}
               </div>
           </div>
           </form>
       </div>
   </div>
</section>

@stop

@section('pageJs')
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
</script>
@stop