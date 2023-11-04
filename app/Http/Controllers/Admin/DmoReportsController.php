<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DmoReportsController extends Controller
{
    public function viewAllDmos(Request $request) {
        $results = User::where('is_dmo', 1)->with('homeVisit', 'telephonicAudit', 'infrastructureAudit')->orderby('name')->get();
        //dd($results);
        return view('layouts.admin.reports.dmos.index', compact('results'));
    }

    public function addNewDmo(Request $request) {
        return view('layouts.admin.reports.dmos.create');
    }
}
