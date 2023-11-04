<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Hospital;
use App\Models\Audit\InfrastructureAudit;
use App\Models\Audit\InfrastructureAuditAttachment;
use DB, Storage, Redirect, Crypt;
class InfrastructureAuditReportsController extends Controller
{
    public function viewAllAudits(Request $request) {
        $all_infra_audits = InfrastructureAudit::with('user', 'hospital')->orderBy('date_of_audit', 'DESC')->paginate(100);
        return view('layouts.admin.reports.audits.infra.index', compact('all_infra_audits'));
    }

    public function viewAudit($id) {
        $id = Crypt::decrypt($id);

        $infra_audit = InfrastructureAudit::with('user', 'hospital', 'attachments')->whereId($id)->first();
        return view('layouts.admin.reports.audits.infra.view_audit', compact('infra_audit'));
    } 
}
