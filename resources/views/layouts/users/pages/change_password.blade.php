@extends('layouts.users.default')
@section('main_content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header mt-3">
                <h3 class="card-title">Change Password</h3>
            </div>
                @if ($errors->any())
                    {!! implode('', $errors->all('
						<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
						  <span class="font-medium">Oops !</span> ::message
						</div>
					')) !!}
                @endif
                {!! Form::open(array('route' => 'reset_password', 'id' => 'reset_password')) !!}
            <div class="card-body">


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
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
