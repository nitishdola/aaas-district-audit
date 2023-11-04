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
                
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Activity Date & Time</th>
                            <th>Activity</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $k => $v)
                        <tr>
                            <td>{{ date('d-m-Y h:i A', strtotime($v->activity_date)) }}</td>
                            <td>{{ $v->activity}} {{ $v->other_activity_name}}</td>
                            <td>{{ $v->activity_remarks }}</td>
                            
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>      
    </div>
</section>
@stop