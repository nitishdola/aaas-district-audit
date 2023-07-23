<?php

namespace App\Http\Controllers\Dmo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DmoController extends Controller
{

    public function __construct()
    {
        $this->middleware('is_dmo');
    }

    public function home(Request $request) {
        $infra_audits = DB::table('infrastructure_audits')->where('user_id', auth()->user()->id)->count();
        $telephonic_audit = DB::table('beneficiary_audits')->where('audit_type', 'telephonic_audit')->where('user_id', auth()->user()->id)->count();
        $home_visit = DB::table('beneficiary_audits')->where('audit_type', 'home_visit')->where('user_id', auth()->user()->id)->count();
        return view('layouts.users.pages.home', compact('infra_audits', 'telephonic_audit', 'home_visit'));
    }
}
