<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audit\BeneficiaryAudit;
use App\Models\Audit\BeneficiaryAuditAttachment;
use DB, Redirect, Crypt;

class BeneficiaryAuditReportsController extends Controller
{
    public function viewAllHomeVisits(Request $request) {
        $all_home_visits = BeneficiaryAudit::with('user', 'tms_data_record')
                                    ->where('audit_type', 'home_visit')
                                    ->orderBy('date_of_audit', 'DESC')
                                    ->paginate(100);
        return view('layouts.admin.reports.audits.beneficiary.home_visit.index', compact('all_home_visits'));
    }

    public function viewHomeVisitAudit($id) {
        $id = Crypt::decrypt($id);

        $home_visit = BeneficiaryAudit::with('user', 'tms_data_record', 'attachments')->whereId($id)->first();
        return view('layouts.admin.reports.audits.beneficiary.home_visit.view', compact('home_visit'));
    }

    public function viewAllTelephonicAudits(Request $request) {
        $results = BeneficiaryAudit::with('user', 'tms_data_record')
                                    ->where('audit_type', 'telephonic_audit')
                                    ->orderBy('date_of_audit', 'DESC')
                                    ->paginate(100);
        return view('layouts.admin.reports.audits.beneficiary.telephonic_audit.index', compact('results'));
    }

    public function viewTelephonicAudit($id) {
        $id = Crypt::decrypt($id);

        $result = BeneficiaryAudit::with('user', 'tms_data_record', 'attachments')->whereId($id)->first();
        return view('layouts.admin.reports.audits.beneficiary.telephonic_audit.view', compact('result'));
    }
}
