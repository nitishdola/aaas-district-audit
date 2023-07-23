<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmsDataRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'tms_data_id', 
        'patient_name', 
        'card_no',

        'hhd_type', 
        'age', 
        'gender',

        'contact_no', 
        'district_name', 
        'pat_state',

        'hospdist', 
        'hosp_name', 
        'hosp_disp_code',

        'hosp_type', 
        'case_no', 
        'case_regn_date',

        'cs_preauth_dt', 
        'cs_dis_dt', 
        'preauth_raised_amt',

        'status', 
        'category_disp_code', 
        'dis_main_name',

        'procedure_disp_id', 
        'procedure_name', 
    ];
}
