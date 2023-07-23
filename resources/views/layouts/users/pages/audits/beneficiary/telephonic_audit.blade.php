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
                   <h3 class="card-title">Telephonic Audit :: {{ $beneficiary_data->case_no }}</h3>
               </div>
               <div class="card-body">
               {!! Form::open(['route' => ['audit.beneficiary.save_telephonic_audit', $beneficiary_data->id], 'files' => true]) !!}
                       <div class="row">
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Case No</label>
                                   {!! Form::text('case_no', $beneficiary_data->case_no, ['class' => 'form-control', 'id' => 'case_no', 'readonly' => true, 'required' => true, 'autocomplete' => 'off']) !!}
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
                       
                       

                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Audit Finding</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" required="required" type="radio" value="Genuine" name="audit_finding">
                                Genuine
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" required="required" type="radio" value="Fraudulent" name="audit_finding">
                                Fraudulent
                              </label>
                            </div>
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
                                    {!! Form::text('attachment_names[]', null, ['class' => 'form-control', 'id' => 'attachment_names',  'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p>.</p>
                                    <label>Upload Document</label>
                                    {!! Form::file('attachments[]', null, ['class' => 'form-control', 'id' => 'attachment_names',  'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary add_more_attachment"><i class="fa fa-plus" aria-hidden="true"></i> Add More Attachment</a>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-success"> Submit</button>
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
    $('.add_more_attachment').click(function(e) {
        var last_clone = $('.attachment:last');
        var clone = $('.attachment:last').clone();
        clone.find("input").val("");
        last_clone.after(clone);
    });
</script>
@stop
