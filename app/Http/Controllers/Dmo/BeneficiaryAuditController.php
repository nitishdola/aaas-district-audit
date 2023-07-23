<?php

namespace App\Http\Controllers\Dmo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\District;
use App\Models\Data\TmsData;
use App\Models\Data\TmsDataRecord;


use App\Models\Audit\BeneficiaryAudit;
use App\Models\Audit\BeneficiaryAuditAttachment;
use DB, Storage, Redirect, Crypt;

class BeneficiaryAuditController extends Controller
{
    public function fetchData() {
        $districts = District::orderBy('name')->pluck('name', 'name');
        return view('layouts.users.pages.audits.beneficiary.fetch_data', compact('districts'));
    }

    public function getData(Request $request) {

        $endpoint = "https://shainsights.in/api/audit/get-all-tms-data";
        $client = new \GuzzleHttp\Client(['verify' => false]);
        

        $response = $client->request('GET', $endpoint, ['query' => [
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'district_name' => $request->district,
            'hosp_type'     => $request->hosp_type,
        ]]);

        $statusCode = $response->getStatusCode();
        $content    = json_decode($response->getBody(), true);

        $tms_data = [];

        $tms_data['user_id']        = auth()->user()->id;
        $tms_data['district_id']    = District::where('name', $request->district)->first()->id;
        $tms_data['hospital_type']  = $request->hosp_type;
        $tms_data['period_from']    = date('Y-m-d', strtotime($request->date_from));
        $tms_data['period_to']      = date('Y-m-d', strtotime($request->date_to));
    

        DB::beginTransaction();
        if($tms_data = TmsData::create($tms_data)) {

            foreach($content as $k => $v) {

                //check if case no exists

                if(!TmsDataRecord::where('case_no', $v['case_no'])->count()):

                    $tms_data_records = [];

                    $tms_data_records['tms_data_id'] = $tms_data->id;
                    $tms_data_records['patient_name'] = $v['patient_name'];
                    $tms_data_records['card_no'] = $v['card_no'];
                    $tms_data_records['hhd_type'] = $v['hhd_type'];
                    $tms_data_records['age'] = $v['age'];
                    $tms_data_records['gender'] = $v['gender'];
                    $tms_data_records['contact_no'] = $v['contact_no'];
                    $tms_data_records['district_name'] = $v['district_name'];
                    $tms_data_records['pat_state'] = $v['pat_state'];
                    $tms_data_records['hospdist'] = $v['hospdist'];
                    $tms_data_records['hosp_name'] = $v['hosp_name'];
                    $tms_data_records['hosp_disp_code'] = $v['hosp_disp_code'];
                    $tms_data_records['hosp_type'] = $v['hosp_type'];
                    $tms_data_records['case_no'] = $v['case_no'];

                    if($v['case_regn_date'] != '') {
                        $reg_date = date('Y-m-d', strtotime($v['case_regn_date']));
                    }

                    $tms_data_records['case_regn_date'] = $reg_date;

                    if($v['cs_preauth_dt'] != '') {
                        $preauth_date = date('Y-m-d', strtotime($v['cs_preauth_dt']));
                    }

                    $tms_data_records['cs_preauth_dt'] = $preauth_date;


                    $cs_dis_dt = NULL;
                    if($v['cs_dis_dt'] != '') {
                        $cs_dis_dt = date('Y-m-d', strtotime($v['cs_dis_dt']));
                    }
                    $tms_data_records['cs_dis_dt'] = $cs_dis_dt;


                    $tms_data_records['preauth_raised_amt'] = $v['preauth_raised_amt'];
                    $tms_data_records['status'] = $v['status'];
                    $tms_data_records['category_disp_code'] = $v['category_disp_code'];

                    if($v['dis_main_name'] != '') {
                        $tms_data_records['dis_main_name'] = $v['dis_main_name'];
                        $tms_data_records['procedure_disp_id'] = $v['procedure_disp_id'];
                        $tms_data_records['procedure_name'] = $v['procedure_name'];
                    }else{
                        $tms_data_records['dis_main_name'] = 'NA';
                        $tms_data_records['procedure_disp_id'] = 'NA';
                        $tms_data_records['procedure_name'] = 'NA';
                    }

                    TmsDataRecord::create($tms_data_records);

                endif;
            }
            
        }
        DB::commit();

        return view('layouts.users.pages.audits.beneficiary.get_data', compact('content'));
    }

    public function viewAllData(Request $request) {
        $tms_data = TmsData::select('id', 'period_from', 'period_to')->where('user_id', auth()->user()->id)->get();
        $result = [];
        if($request->search == 'yes') {
            $result = TmsDataRecord::where('tms_data_id', $request->preauth_range)->get();
        }
        
        return view('layouts.users.pages.audits.beneficiary.view_all_data', compact('tms_data', 'result', 'request'));
    }

    public function viewDetails(Request $request, $tms_record_id) {
        $tms_record_id      = Crypt::decrypt($tms_record_id);
        $beneficiary_data   = TmsDataRecord::where('id', $tms_record_id)->first();
        return view('layouts.users.pages.audits.beneficiary.view_details', compact('beneficiary_data'));
    }

    public function homeVisit(Request $request, $tms_record_id) {
        $tms_record_id = Crypt::decrypt($tms_record_id);
        $beneficiary_data = TmsDataRecord::where('id', $tms_record_id)->first();
        return view('layouts.users.pages.audits.beneficiary.home_visit', compact('beneficiary_data'));
    }

    public function saveHomeVisit(Request $request, $tms_data_record_id) {
        $tms_data_record_id = Crypt::decrypt($tms_data_record_id);
        $beneficiary_data = TmsDataRecord::where('id', $tms_data_record_id)->first();
       

        $this->validate($request,[
            'latitude'                      => 'required',
            'longitude'                     => 'required',
            'address_of_the_beneficiary'    => 'required|min:10|max:255',
            'remarks'                       => 'required|min:10|max:255',
            'satsfied'                      => 'required|in:YES,NO',
            'cashless'                      => 'required|in:YES,NO',

            'attachment_names.*'            => 'required|max:255',
            'attachments.*'                 => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2048',

            'beneficiary_photo'             => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2048',

            'cash_memo'                     => 'required_if:cashless,==,NO|mimes:jpg,jpeg,png,bmp,pdf|max:2048',
        ]);

        $data = [];
        $data['audit_type'] = 'Home Visit';
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['tms_data_record_id'] = $tms_data_record_id;
        $data['address_of_the_beneficiary'] = $request->address_of_the_beneficiary;
        $data['remarks'] = $request->remarks;
        $data['satsfied'] = $request->satsfied;
        $data['cashless'] = $request->cashless;
        $data['audit_type'] = 'home_visit';
        $data['user_id'] = auth()->user()->id;
        $data['date_of_audit'] = date('Y-m-d');
        DB::beginTransaction();

        

        if($request->hasFile('beneficiary_photo')){
            $dir      = '/audit/home_visit/'.auth()->user()->id;
            $file = $request->file('beneficiary_photo');
            $beneficiary_photo = 'home_visit_beneficiary_photo_'.uniqid().md5(time()).'.'. $file->getClientOriginalExtension();
            $file->move(public_path().$dir, $beneficiary_photo);
            $data['photo_of_beneficiary'] = $beneficiary_photo;
        }else{
            return Redirect::back()->withInput()->with(['message' => 'Beneficiary Photo is Missing']);
        }


        if($request->hasFile('cash_memo')){
            $dir      = '/audit/home_visit/'.auth()->user()->id.'/'.date('d-m-Y');
            $file = $request->file('cash_memo');
            $cash_memo = 'home_visit_cash_memo_'.uniqid().md5(time()).'.'. $file->getClientOriginalExtension();
            $file->move(public_path().$dir, $cash_memo);
            $data['cashless_treatment_no_receipt'] = $cash_memo;
        }

        //dd($data);

        $home_visit_audit = BeneficiaryAudit::create($data);

        if($request->hasFile('attachments')) {
            $allowedfileExtension=['pdf','jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('attachments');

            foreach($files as $k => $file){
                $fileName   = $file->getClientOriginalName();
                $extension  = $file->getClientOriginalExtension();
                $check      = in_array($extension,$allowedfileExtension);

                if($check) {

                    $fileModel = new BeneficiaryAuditAttachment;

                    $attachment_name = '';
                    $attachment_name .= $request->attachment_names[$k];
                    $attachment_name = str_replace(' ', '_', $attachment_name);

                    $fileName  = md5(time()).$attachment_name.'_'.$fileName ;
                    $filePath = $file->storeAs('uploads/benefciary_audit', $fileName, 'public');
                    //$path = 'audit/infra/'.$infra_audit->id;

                    //Storage::disk('local')->put($path, $filename, 'public');

                    $fileModel->beneficiary_audit_id = $home_visit_audit->id;
                    $fileModel->attachment_name = $request->attachment_names[$k];
                    $fileModel->attachment_path = '/storage/' . $filePath;

                    $fileModel->save();
                   
                }
            }
        }

        $tms_data_record = TmsDataRecord::find($tms_data_record_id);
        $tms_data_record->home_visit_completed = true;
        $tms_data_record->save();

        DB::commit();

        return Redirect::route('dmo.home')->with(['message' => 'Home visit audit submitted.', 'alert-class' => 'alert-success']);
    }

    public function viewAllHomeVisit(Request $request) {
        $districts = District::orderBy('name')->pluck('name', 'name');

        $where = [];
        $res = BeneficiaryAudit::where('user_id', auth()->user()->id)
                ->where('audit_type', 'home_visit')
                ->with('tms_data_record', 'user');
        if($request->date_of_audit_from) {
            $res = $res->where('date_of_audit', '>=', date('Y-m-d', strtotime($request->date_of_audit_from)));
        }

        if($request->date_of_audit_to) {
            $res = $res->where('date_of_audit', '<=', date('Y-m-d', strtotime($request->date_of_audit_to)));
        }
        
        $results = $res->paginate(100);
        return view('layouts.users.pages.audits.beneficiary.view_all_home_visits', compact('results', 'districts'));
    }

    public function viewHomeVisit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $result = BeneficiaryAudit::where('id', $id)
                                    ->where('audit_type', 'home_visit')
                                    ->with('tms_data_record', 'user', 'attachments')
                                    ->first();
                                    //dd($result);
        return view('layouts.users.pages.audits.beneficiary.view_home_visit', compact('result'));
    }

    public function telephonicAudit(Request $request, $tms_record_id) {
        $tms_record_id = Crypt::decrypt($tms_record_id);
        $beneficiary_data = TmsDataRecord::where('id', $tms_record_id)->first();
        return view('layouts.users.pages.audits.beneficiary.telephonic_audit', compact('beneficiary_data'));
    }

    public function saveTelephonicAudit(Request $request, $tms_data_record_id) {
        
        $this->validate($request,[
            'audit_finding'             => 'required',
            'remarks'                   => 'required|min:10',
            //'attachment_names.*'        => 'required|max:255',
            //'attachments.*'             => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2048',
        ]);

        $data = [];
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['tms_data_record_id'] = $tms_data_record_id;
        $data['telephonic_audit_finding'] = $request->audit_finding;
        $data['remarks'] = $request->remarks;
        $data['date_of_audit'] = date('Y-m-d');
        $data['audit_type'] = 'telephonic_audit';

        DB::beginTransaction();

        $beneficiary_audit = BeneficiaryAudit::create($data);

        $allowedfileExtension=['pdf','jpg', 'jpeg', 'png', 'bmp'];
        $files = $request->file('attachments');
        //dd($files);
        if($files != null):
        foreach($files as $k => $file){ 
            $fileName   = $file->getClientOriginalName();
            $extension  = strtolower($file->getClientOriginalExtension());
            $check      = in_array($extension,$allowedfileExtension);
            
            if($check) {
               

                $fileModel = new BeneficiaryAuditAttachment;

                $attachment_name = '';
                $attachment_name .= $request->attachment_names[$k];
                $attachment_name = str_replace(' ', '_', $attachment_name);

                $fileName  = md5(time()).$attachment_name.'_'.$fileName ;
                $file->storeAs('uploads/beneficiary_audit', $fileName, 'public');

                $filePath = 'uploads/beneficiary_audit/'.$fileName;

                $fileModel->beneficiary_audit_id = $beneficiary_audit->id;
                $fileModel->attachment_name = $request->attachment_names[$k];
                $fileModel->attachment_path = $filePath;

                $fileModel->save();
               
            }
        }
        endif;

        $tms_data_record = TmsDataRecord::find($tms_data_record_id);
        $tms_data_record->telephonic_audit_completed = true;
        $tms_data_record->save();

        DB::commit();

        return Redirect::route('audit.beneficiary.view_all_data')->with(['message' => 'Telephonic audit submitted.', 'alert-class' => 'alert-success']);

    }

    public function viewAllTepephonicAudit(Request $request) {

        $where = [];
        $res = BeneficiaryAudit::where('user_id', auth()->user()->id)
                ->where('audit_type', 'telephonic_audit')
                ->with('tms_data_record', 'user');
        if($request->date_of_audit_from) {
            $res = $res->where('date_of_audit', '>=', date('Y-m-d', strtotime($request->date_of_audit_from)));
        }

        if($request->date_of_audit_to) {
            $res = $res->where('date_of_audit', '<=', date('Y-m-d', strtotime($request->date_of_audit_to)));
        }
        
        $results = $res->paginate(100);
        return view('layouts.users.pages.audits.beneficiary.view_all_telephonic_audits', compact('results'));
    }

    public function viewTepephonicAudit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $result = BeneficiaryAudit::where('id', $id)
                                    ->where('audit_type', 'telephonic_audit')
                                    ->with('tms_data_record', 'user', 'attachments')
                                    ->first();
                                    //dd($result);
        return view('layouts.users.pages.audits.beneficiary.view_telephonic_audit', compact('result'));
    }
}
