<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DB, Redirect;
use App\Models\Activity;
use App\Models\User;
class ActivityReportsController extends Controller
{
    public function viewActivity(Request $request, $date, $user_id) {
        $acitivities = Activity::whereDate('activity_date', $date)
                        ->where('user_id', $user_id)
                        ->get(); //dd($acitivities);
        $user = User::whereId($user_id)->first()->name;
        return view('layouts.admin.reports.activity.reports', compact('acitivities', 'date', 'user'));
    }

    public function viewUsers(Request $request) {
        $users = User::where('is_dmo', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('layouts.admin.reports.activity.view_users', compact('users'));
    }

    public function viewUsersActivity(Request $request) {
        
        $first_day = date('Y-m-d', strtotime('01-'.$request->month));
        
        $user = User::whereId($request->user_id)->first();
        return view('layouts.admin.reports.activity.view_users_activity', compact( 'first_day', 'user'));
    }
}
