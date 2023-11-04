@extends('layouts.admin.default')

@section('main_content')
<div class="row">
<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title"> Month : {{ date('M-Y', strtotime($first_day)) }} User : {{ $user->name }}</h5>

               
                @php 

                $list=array();
                $month = date('m', strtotime($first_day));
                $year = date('Y', strtotime($first_day));

                for($d=1; $d<=31; $d++)
                {
                    $time=mktime(12, 0, 0, $month, $d, $year);          
                    if (date('m', $time)==$month)       
                        $list[]=date('d-m-Y', $time);
                }
                @endphp

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for($i = 0; $i < count($list); $i++)
                        <tr>
                            <td> 
                                <a href="{{ route(
                                            'admin.daily_activity.view_activity', 
                                            [date('Y-m-d', strtotime($list[$i])),
                                            $user->id]        
                                                ) 
                                        }}" target="_blank">
                                    {{ $list[$i]}} 
                                </a>
                            </td>
                            @php 
                                $acitivities = DB::table('activities')
                                                ->whereDate('activity_date', date('Y-m-d', strtotime($list[$i])))
                                                ->where('user_id', $user->id)
                                                ->get();
                            @endphp 

                            @foreach($acitivities as $k => $v)
                                <td>{{ $v->activity}} {{ $v->other_activity_name}} <br>
                                    {{ date('h:i A', strtotime($v->activity_date)) }}
                                </td>
                            @endforeach
                        </tr>
                        @endfor
                    </tbody>
                </table>
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
        </ol>
    </nav>
</div><!-- End Page Title -->
@stop
