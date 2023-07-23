<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\District;

class Hospital extends Model
{
    use HasFactory;

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
}
