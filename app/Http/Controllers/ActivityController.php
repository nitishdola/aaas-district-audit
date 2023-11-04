<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, DB, Redirect;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function create() {
        return view('layouts.users.activity.create');
    }

    public function store(Request $request) {


        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'activity' => 'required',
            'activity_remarks' => 'required',
            'other_activity_name' => 'required_if:activity,Others Activity',
        ]);

        if ($validator->fails()) {
            toastr()->error('Oops! Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data = [];

        $data['activity_date'] = date('Y-m-d H:i:s');
        $data['user_id'] = auth()->user()->id;

        $data['latitude']         = $request->latitude;
        $data['longitude']        = $request->longitude;

        if($request->activity != '') {
            $data['activity']             = $request->activity;
            $data['activity_remarks']     = $request->activity_remarks; 
            $data['other_activity_name']  = $request->other_activity_name;
        }
        DB::beginTransaction();
        Activity::create($data);
        DB::commit();

        toastr()->success('Activity submitted');
        return Redirect::route('daily_activity.index')->with(['message' => 'Daily activity submitted.', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $date = date('Y-m-d');
        $activities = Activity::where('user_id', auth()->user()->id)
                        ->whereDate('activity_date', $date)
                        ->orderBy('activity_date', 'DESC')
                        ->get();
        return view('layouts.users.activity.index', compact('activities'));
    }
}
