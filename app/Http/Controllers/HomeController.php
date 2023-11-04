<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit\BeneficiaryAudit;
use DB, Storage, Redirect, Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handleAdmin()
    {
        $infra_audits = DB::table('infrastructure_audits')->count();
        $telephonic_audit = DB::table('beneficiary_audits')->where('audit_type', 'telephonic_audit')->count();
        $home_visit = DB::table('beneficiary_audits')->where('audit_type', 'home_visit')->count();
        
        $latest_home_visits = BeneficiaryAudit::where('audit_type', 'home_visit')
                                    ->with('tms_data_record', 'user', 'attachments')
                                    ->orderBy('date_of_audit', 'DESC')->limit(10)->get();

        return view('layouts.admin.home', compact('infra_audits', 'telephonic_audit', 'home_visit', 'latest_home_visits'));
    }

    public function changePassword(Request $request) {
        return view('layouts.users.pages.change_password');
    }

    public function resetPassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:5|string'
        ]);
        $auth = Auth::user();

        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            toastr()->error('Current Password is Invalid');
            return back()->with('error', "Current Password is Invalid");
        }
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            toastr()->error('New Password cannot be same as your current password');
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }
 
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        toastr()->success('Password Changed Successfully');
        return back()->with('success', "Password Changed Successfully");
    }
}
