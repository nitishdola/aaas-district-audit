<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Master\Hospital;
class InfrastructureAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id', 
        'date_of_audit', 
        'latitude',
        'longitude',
        'user_id', 
        'existence_of_hospital', 
        'infrastructure_empanelled_as_per_specialty', 
        'infrastructure_remarks', 
        'manpower_exist_as_per_specialty', 
        'manpower_remarks', 
        'remarks', 
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\Audit\InfrastructureAuditAttachment');
    }
}
