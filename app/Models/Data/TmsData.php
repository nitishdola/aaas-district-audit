<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class TmsData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'district_id',
        'hospital_type',
        'period_from', 
        'period_to',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
