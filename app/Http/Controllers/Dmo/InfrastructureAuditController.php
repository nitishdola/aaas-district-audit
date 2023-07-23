<?php

namespace App\Http\Controllers\Dmo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Hospital;
use App\Models\Audit\InfrastructureAudit;
use App\Models\Audit\InfrastructureAuditAttachment;
use DB, Storage, Redirect;
use GuzzleHttp\Client;
use GuzzleHttp;
class InfrastructureAuditController extends Controller
{
    public function create() {
        $hospitals = Hospital::orderBy('name')->pluck('name', 'id');
        return view('layouts.users.pages.audits.infra.create', compact('hospitals'));
    }

    public function save(Request $request) {

        //dd($request->all());
        $this->validate($request,[
            'hospital_id'               => 'required|exists:hospitals,id',
            'date_of_audit'             => 'required|date|date_format:Y-m-d',

            'latitude' => 'required',
            'longitude' => 'required',

            'existence_of_hospital'     => 'required|in:1,0',
            
            'infrastructure_empanelled_as_per_specialty' => 'required|in:1,0',
            'infrastructure_remarks'    => 'required_if:infrastructure_empanelled_as_per_specialty,==,0',

            'manpower_exist_as_per_specialty' => 'required|in:1,0',
            'manpower_remarks'          => 'required_if:manpower_exist_as_per_specialty,==,0',

            'remarks'                   => 'required|min:10',

            'attachment_names.*'        => 'required|max:255',
            'attachments.*'             => 'required|mimes:jpg,jpeg,png,bmp,pdf|max:2048',
        ]);

        $data = [];
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;


        DB::beginTransaction();

        $infra_audit = InfrastructureAudit::create($data);

        if($request->hasFile('attachments')) {
            $allowedfileExtension=['pdf','jpg', 'jpeg', 'png', 'bmp'];
            $files = $request->file('attachments');

            foreach($files as $k => $file){
                $fileName   = $file->getClientOriginalName();
                $extension  = strtolower($file->getClientOriginalExtension());
                $check      = in_array($extension,$allowedfileExtension);

                if($check) {

                    $fileModel = new InfrastructureAuditAttachment;

                    $attachment_name = '';
                    $attachment_name .= $request->attachment_names[$k];
                    $attachment_name = str_replace(' ', '_', $attachment_name);

                    $fileName  = md5(time()).$attachment_name.'_'.$fileName ;
                    $file->storeAs('uploads/infrastructure_audit', $fileName, 'public');

                    $filePath = 'uploads/infrastructure_audit/'.$fileName;

                    $fileModel->infrastructure_audit_id = $infra_audit->id;
                    $fileModel->attachment_name = $request->attachment_names[$k];
                    $fileModel->attachment_path = $filePath;

                    $fileModel->save();
                   
                }
            }
        }
        DB::commit();

        return Redirect::route('dmo.home')->with(['message' => 'Infrastructure audit submitted.', 'alert-class' => 'alert-success']);
    }

    public function viewAllAudits(Request $request) {
        $hospitals = Hospital::orderBy('name')->pluck('name', 'id');
        $data = InfrastructureAudit::where('user_id', auth()->user()->id);
        $where = [];
        if($request->hospital_id) {
            $data = $data->where('hospital_id', $request->hospital_id);
        }

        if($request->date_of_audit_from) {
            $date_from = date('Y-m-d', strtotime($request->date_of_audit_from));
            $data = $data->where('date_of_audit', '>=', $date_from);
        }

        if($request->date_of_audit_to) {
            $date_to = date('Y-m-d', strtotime($request->date_of_audit_to));
            $data = $data->where('date_of_audit', '<=', $date_to);
        }


        $results = $data->with('hospital', 'hospital.district')->paginate(1000);
        return view('layouts.users.pages.audits.infra.index', compact('hospitals', 'results'));
    }

    public function viewAudit($id) {
        
        $result = InfrastructureAudit::where('id', $id)->with('hospital', 'attachments', 'hospital.district')->first();
        return view('layouts.users.pages.audits.infra.view', compact( 'result'));
    }
}
