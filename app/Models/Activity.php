<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Activity extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'activity_date',
        'latitude', 
        'longitude', 
        'activity', 
        'activity_remarks',  
        'other_activity_name',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
