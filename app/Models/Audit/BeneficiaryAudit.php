<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\TmsDataRecord;
use App\Models\User;
class BeneficiaryAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_audit',
        'tms_data_record_id', 
        'telephonic_audit_finding', 
        'latitude', 
        'longitude', 
        'address', 
        'beneficiary_satisfied_with_treatment',  
        'photo_of_beneficiary',
        'cashless_treatment_no_receipt', 
        'cashless_treatment', 
        'audit_type', 
        'remarks', 
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function tms_data_record(){
        return $this->belongsTo(TmsDataRecord::class,'tms_data_record_id');
    }
    public function attachments()
    {
        return $this->hasMany('App\Models\Audit\BeneficiaryAuditAttachment');
    }
}
