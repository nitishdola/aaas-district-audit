<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastructureAuditAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'infrastructure_audit_id', 
        'attachment_name', 
        'attachment_path',
    ];
}
